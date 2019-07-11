<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Admin\Models\Traits\Sluggable;

    public $category_ids = [];

    protected $attributes = [
        'images' => '[]'
    ];

    protected $fillable = [
        'name',
        'published',
        'slug',
        'price',
        'images',
        'meta_title',
        'meta_description',
        'meta_keywords'
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
        return \Admin\Models\Image::find($imageId);
    }

    public function images()
    {
        $imagesIds = $this->images ?: [];
        $images = \Admin\Models\Image::find($imagesIds);
        return $images ?: [(new \Admin\Models\Image(['url' => '/images/default.png']))];
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_product');
    }
}
