<?php

namespace App\Models;

class Product extends BaseModel
{
    public $category_ids = [];

    protected $guarded = ['category_ids', 'created_at', 'updated_at'];

    protected $attributes = [
        'images' => '[]'
    ];

    protected $casts = [
        'published' => 'boolean',
        'images' => 'array'
    ];

    public $logFields = [
        'name',
        'published',
        'slug',
        'price',
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
                'name' => 'category_ids',
                'type' => 'select',
                'options' => ProductCategory::pluck('name', 'id'),
                'multi' => true,
                'label' => 'Категории'
            ],
            [
                'name' => 'price',
                'type' => 'input',
                'label' => 'Цена'
            ],
            [
                'name' => 'images[]',
                'type' => 'image',
                'multi' => true,
                'label' => 'Изображения'
            ],
            'meta_title',
            'meta_description',
            'meta_keywords'
        ];

        return $fields;
    }

    public function firstImage()
    {
        $imagesIds = $this->images ?: [];
        $imageId = array_shift($imagesIds);
        return \App\Models\Image::find($imageId);
    }

    public function images()
    {
        $imagesIds = $this->images ?: [];
        $images = \App\Models\Image::find($imagesIds);
        return $images ?: [(new \App\Models\Image(['url' => '/images/default.png']))];
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_product');
    }
}
