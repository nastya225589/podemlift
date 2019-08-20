<?php

namespace App\Models;

class Product extends BaseModel
{
    public $category_ids = [];

    protected $guarded = ['category_ids', 'properties', 'created_at', 'updated_at'];

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
            [
                'name' => 'properties',
                'type' => 'properties',
                'options' => ProductProperty::select('name AS label', 'id AS value', 'type')->get(),
                'label' => 'Параметры'
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
        return Image::find($imageId);
    }

    public function images()
    {
        $imagesIds = $this->images ?: [];
        $images = Image::find($imagesIds);
        return $images ?: [(new Image(['url' => '/images/default.png']))];
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_product');
    }

    public function properties()
    {
        return $this->hasMany(ProductPropertyValue::class, 'product_id', 'id')
            ->join('product_properties', 'product_properties.id', 'product_properties_values.property_id');
    }

    public function getUrl()
    {
        return '/product/'.$this->slug;
    }

    protected function setProperties(string $props)
    {
        $propsArray = [];
        $props = json_decode($props);
        foreach ($props as $prop) {
            $arr = [];
            $arr['property_id'] = $prop->property->value;
            $arr['value'] = $prop->value;
            array_push($propsArray, $arr);
        }
        $this->properties()->delete();
        if ($propsArray) {
            $this->properties()->createMany($propsArray);
        }
    }
}
