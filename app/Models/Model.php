<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class Model extends \Illuminate\Database\Eloquent\Model
{
    public $columns;

    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            Log::model($model);
        });

        static::creating(function($model) {
            if (!in_array('sort', $model->columns()))
                return;

            $max = static::when(in_array('parent_id', $model->columns()), function ($q) use ($model) {
                return $q->where('parent_id', $model->parent_id);
            })->max('sort');

            $model->sort = $max === null ? 0 : $max + 1;
        });

        static::saving(function($model)
        {
            if (array_diff(['url', 'slug', 'parent_id'], $model->columns()))
                return;

            $newUrl = $model->fullUrl();

            if ($newUrl != $model->url) {
                if ($model->id && $model->url)
                    Redirect::firstOrCreate([
                        'from' => $model->url,
                        'model' => static::class,
                        'model_id' => $model->id
                    ]);

                $model->url = $newUrl;
            }
        });

        static::saved(function($model) {
            if (array_diff(['url', 'slug', 'parent_id'], $model->columns()))
                return;

            if (count($model->childrens))
                foreach ($model->childrens as $children)
                    if ($children->url != $children->fullUrl())
                        $children->save();
        });
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort');
    }

    public function setSlugAttribute($value)
    {
        if ($value != '/')
            $value = Str::slug($value) ?: Str::slug($this->attributes['name']);

        $where = [['id', '!=', $this->getAttribute('id')]];

        if (array_key_exists('parent_id', $this->attributes))
            $where = array_merge($where, [['parent_id', '=', $this->parent_id]]);

        while (self::where(array_merge($where, [['slug', '=', $value]]))->count()) {
            if (!preg_match('~^(.+-)(\d+)$~', $value))
                $value = $value . '-1';
            else
                $value = preg_replace_callback('~^(.+-)(\d+)$~', function ($data) {
                    return $data[1] . ($data[2] + 1);
                }, $value);
        }

        $this->attributes['slug'] = $value;
    }

    public function parent()
    {
        return $this->belongsTo(static::class);
    }

    public function childrens()
    {
        return $this->hasMany(static::class, 'parent_id', 'id')->orderBy('sort');
    }

    public function columns()
    {
        if ($this->columns)
            return $this->columns;

        $this->columns = Schema::getColumnListing($this->getTable());

        return $this->columns;
    }

    public function fullUrl()
    {
        $url = '/' . trim($this->slug, '/');
        $parent = $this->parent;
        while ($parent) {
            $slug = trim($parent->slug, '/');
            if (!empty($slug))
                $url = '/' . $slug . $url;
            $parent = $parent->parent;
        }

        return $url;
    }
}
