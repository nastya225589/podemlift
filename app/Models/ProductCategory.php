<?php

namespace App\Models;

class ProductCategory extends BaseModel
{
    protected $guarded = ['property_ids', 'redirects'];

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
                'name' => 'property_ids',
                'type' => 'select',
                'options' => ProductProperty::pluck('name', 'id'),
                'multi' => true,
                'label' => 'Фильтры'
            ],
            [
                'name' => 'redirects',
                'type' => 'redirects',
                'label' => 'Редиректы'
            ],
            [
                'name' => 'content',
                'type' => 'builder',
                'label' => 'Текст',
                'allowed' => [
                    'tinymce',
                    'header',
                    'subtitle',
                    'two_cols'
                ]
            ],
            'meta_title',
            'meta_description',
            'meta_keywords'
        ];

        return $fields;
    }

    public function products()
    {
        $childCategoriesIds = ProductCategory::where('parent_id', $this->id)->pluck('id')->toArray();
        $childCategoriesIds = array_merge($childCategoriesIds, ProductCategory::whereIn('parent_id', $childCategoriesIds)->pluck('id')->toArray());
        if (count($childCategoriesIds)) {
            return $this->childCategoriesProducts($childCategoriesIds);
        } else {
            return $this->belongsToMany(Product::class, 'product_category_product');
        }
    }

    public function property($property)
    {
        $productIds = $this->products()->pluck('id');
        if ($property->type == 'text') {
            $value = ProductPropertyValue::whereIn('product_id', $productIds)
                ->join('product_properties', 'product_properties.id', 'product_properties_values.property_id')
                ->where('name', $property->name)->first()->value;
        } else {
            $query = ProductPropertyValue::whereIn('product_id', $productIds)
                ->join('product_properties', 'product_properties.id', 'product_properties_values.property_id')
                ->where('name', $property->name);
            $value = $query->max('int_value');
        }
        
        return $value;
    }

    public function image()
    {
        if ($this->products()->first())
            return $this->products()->first()->firstImage()->url;
    }

    public function price()
    {
        return $this->products()->min('price');
    }

    public function properties()
    {
        return $this->belongsToMany(ProductProperty::class, 'product_category_product_property');
    }

    public function fullUrl()
    {
        $url = parent::fullUrl();
        $page = Page::where('behavior', 'catalog')->first();
        return $page->url . $url;
    }

    public function seoData()
    {
        return $this->hasMany(SeoData::class);
    }

    protected function childCategoriesProducts($childCategoriesIds)
    {
        return Product::join('product_category_product', 'products.id', 'product_category_product.product_id')
            ->whereIn('product_category_id', $childCategoriesIds);
    }
}
