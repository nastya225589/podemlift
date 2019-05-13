<?php

namespace Admin\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use SoftDeletes;

    protected $attributes = [
        'fields' => '{}'
    ];

    protected $fillable = [
        'name',
        'published',
        'behavior',
        'parent_id',
        'sort',
        'slug',
        'content',
        'fields',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'published' => 'boolean',
        'fields' => 'array'
    ];

    public $logFields = [
        'name',
        'published',
        'parent_id',
        'sort',
        'slug',
        'content',
        'fields',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    public function formFields()
    {
        $fields = [
            [
                'name' => 'name',
                'type' => 'input',
                'label' => 'Название'
            ],
            [
                'name' => 'published',
                'type' => 'checkbox',
                'label' => 'Опубликован'
            ],
            [
                'name' => 'slug',
                'type' => 'input',
                'label' => 'Url'
            ],
            [
                'name' => 'content',
                'type' => 'editor',
                'label' => 'Текст'
            ]
        ];

        if ($this->behavior == 'demo')
            $fields = array_merge($fields, [
                [
                    'name' => 'fields[map]',
                    'type' => 'input',
                    'label' => 'Карта'
                ],
                [
                    'name' => 'fields[image]',
                    'type' => 'image',
                    'label' => 'Картинка'
                ],
                [
                    'name' => 'fields[slider][]',
                    'type' => 'image',
                    'multi' => true,
                    'label' => 'Слайдер'
                ]
            ]);

        if ($this->behavior == 'demo')
            $fields = array_merge($fields, [
                [
                    'name' => 'fields[builder]',
                    'type' => 'builder',
                    'label' => 'Контент'
                ],
                [
                    'name' => 'fields[gallery]',
                    'type' => 'gallery',
                    'label' => 'Галерея'
                ]
            ]);

        $fields = array_merge($fields, [

            'meta_title',
            'meta_description',
            'meta_keywords',
        ]);

        return $fields;
    }

    public function getAttribute($key)
    {
        $return = parent::getAttribute($key);
        if ($return === null && isset($this->fields[$key]))
            $return = $this->fields[$key];

        return $return;
    }

    public function validatorRules($data)
    {
        return [
            'parent_id' => 'nullable|integer|exists:pages,id',
            'published' => 'boolean',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'fields' => 'array',
        ];
    }

    public function setSlugAttribute($value)
    {
        if ($value != '/')
            $value = str_slug($value) ?: str_slug($this->attributes['name']);

        while (self::where([['id', '<>', $this->id], ['parent_id', '=', $this->parent_id], ['slug', '=', $value]])->count()) {
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
        return $this->belongsTo(self::class);
    }

    public function childrens()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->orderBy('sort');
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

    public function firstImage($default = '')
    {
        if (!empty($this->image))
            return $this->image;

        if (!empty($this->images) && $this->images->first()->image)
            return $this->images->first()->image;

        return $default;
    }

    public static function dropdown($not = null, $parentId = null, $parentName = null)
    {
        $in = [1];
        if ($not)
            $in[] = $not;

        if ($parentId)
            $out = [];
        else
            $out = ['' => ''];

        $models = self::where(['parent_id' => $parentId])->get();
        if ($models)
            foreach ($models as $model) {
                $out[$model->id] = $parentName ? $parentName . $model->name : $model->name;
                if (count($model->childrens))
                    $out += self::dropdown(null, $model->id, $parentName . $model->name . ' > ');
            }

        return $out;
    }

    public static function getUrl($id)
    {
        $model = self::firstOrNew(['id' => $id]);
        return $model->url ?: '#notFound';
    }
}
