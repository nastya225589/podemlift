<?php

namespace App\Models;

class ProductCategory extends BaseModel
{
    public $logFields = [
        'parent_id',
        'sort',
        'name',
        'slug',
        'published',
        'content',
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
                'type' => 'builder',
                'label' => 'Текст'
            ],
            'meta_title',
            'meta_description',
            'meta_keywords'
        ];

        return $fields;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category_product');
    }

    public function fullUrl()
    {
        $url = parent::fullUrl();
        $page = Page::where('behavior', 'catalog')->first();
        return $page->url . $url;
    }
}
