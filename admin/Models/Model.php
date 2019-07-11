<?php

namespace Admin\Models;

use Illuminate\Support\Str;

class Model extends \Illuminate\Database\Eloquent\Model
{
    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort', 'acs');
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
}
