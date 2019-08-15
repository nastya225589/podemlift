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
        $childCategoriesIds = ProductCategory::where('parent_id', $this->id)->pluck('id');
        if (count($childCategoriesIds))
            return $this->childCategoriesProducts($childCategoriesIds);
        else
            return $this->belongsToMany(Product::class, 'product_category_product');
    }

    public function fullUrl()
    {
        $url = parent::fullUrl();
        $page = Page::where('behavior', 'catalog')->first();
        return $page->url . $url;
    }

    protected function childCategoriesProducts($childCategoriesIds)
    {
        return Product::join('product_category_product', 'products.id', 'product_category_product.product_id')->whereIn('product_category_id', $childCategoriesIds);
    }
}
