<?php

namespace App\Models;

class Work extends BaseModel
{
    protected $attributes = [
        'images' => '[]'
    ];

    protected $casts = [
        'published' => 'boolean',
        'images' => 'array',
    ];

    public $logFields = [
        'name',
        'published',
        'category_id',
        'slug',
        'introtext',
        'text',
        'images',
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
                'name' => 'category_id',
                'type' => 'select',
                'label' => 'Категория',
                'options' => WorkCategory::pluck('name', 'id')
            ],
            [
                'name' => 'introtext',
                'type' => 'textarea',
                'label' => 'Текст превью'
            ],
            [
                'name' => 'images[]',
                'type' => 'image',
                'multi' => true,
                'label' => 'Изображения'
            ],
            [
                'name' => 'text',
                'type' => 'editor',
                'label' => 'Текст'
            ],
            'meta_title',
            'meta_description',
            'meta_keywords'
        ];

        return $fields;
    }

    public function firstImage()
    {
        $images = $this->images;
        $image = array_shift($images);
        return Image::findOrNew($image);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\WorkCategory', 'category_id');
    }

    public function images()
    {
        $imagesIds = $this->images ?: [];
        $images = Image::find($imagesIds);
        return $images ?: [(new Image(['url' => '/images/default.png']))];
    }

    public function validatorRules($data)
    {
        $rules = parent::validatorRules($data);
        return array_merge($rules, [
            'introtext' => 'required'
        ]);
    }
}
