<?php

namespace App\Models;

class ApplicationSphere extends BaseModel
{
    public $category_ids = [];

    protected $guarded = ['category_ids', 'property_ids', 'created_at', 'updated_at'];

    public $logFields = [
        'name',
        'published',
        'slug',
        'text',
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
                'label' => 'Категории',
                'multi' => true,
                'options' => ProductCategory::pluck('name', 'id')
            ],
            [
                'name' => 'property_ids',
                'type' => 'select',
                'label' => 'Параметры для вывода в сравнительной таблице',
                'multi' => true,
                'options' => ProductProperty::pluck('name', 'id')
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

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'application_sphere_product_category', 'sphere_id', 'category_id');
    }

    public function properties()
    {
        return $this->belongsToMany(ProductProperty::class, 'application_sphere_product_property', 'sphere_id', 'property_id');
    }
}
