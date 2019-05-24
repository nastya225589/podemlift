<?php

namespace Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Traits\Sluggable;

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
            ]
        ];

        if ($this->behavior == 'main')
            $fields = array_merge($fields, [
                [
                    'name' => 'fields[main_image]',
                    'type' => 'image',
                    'label' => 'Основное изображение (1920x600)'
                ],
                [
                    'name' => 'fields[main_image_text]',
                    'type' => 'input',
                    'label' => 'Текст основного изображения'
                ],
                [
                    'name' => 'fields[about_company]',
                    'type' => 'gallery',
                    'label' => 'О компании'
                ],
                [
                    'name' => 'fields[content_title]',
                    'type' => 'input',
                    'label' => 'Заголовок текста'
                ],
            ]);

        $fields = array_merge($fields, [
            [
                'name' => 'content',
                'type' => 'editor',
                'label' => 'Текст'
            ],
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

    public function image($imageName)
    {
        return Image::findOrNew($this->$imageName);
    }

    public function firstImage($default = '')
    {
        if (!empty($this->image))
            return $this->image;

        if (!empty($this->images) && $this->images->first()->image)
            return $this->images->first()->image;

        return $default;
    }

    public function collection($fieldName)
    {
        $data = json_decode($this->$fieldName);
        return collect($data);
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
