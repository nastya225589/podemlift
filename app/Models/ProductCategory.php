<?php

namespace App\Models;

class ProductCategory extends BaseModel
{
    protected $attributes = [
        'images' => '[]'
    ];

    protected $casts = [
        'images' => 'array',
    ];

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
                'name' => 'images[]',
                'type' => 'image',
                'multi' => true,
                'label' => 'Слайдер'
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
        $childCategoriesIds = $this->getChildCategoriesIds();
        if (count($childCategoriesIds)) {
            return $this->childCategoriesProducts($childCategoriesIds);
        } else {
            return $this->belongsToMany(Product::class, 'product_category_product');
        }
    }

    protected function getChildCategoriesIds()
    {
        $loop = true;
        $childCategoriesIds = ProductCategory::where('parent_id', $this->id)->pluck('id')->toArray();;
        $childs = $childCategoriesIds;
        while ($loop) {
            $childs = ProductCategory::whereIn('parent_id', $childs)->pluck('id')->toArray();
            if (count($childs)) {
                $childCategoriesIds = array_merge($childCategoriesIds, $childs);
            } else {
                $loop = false;
            }            
        }
        return $childCategoriesIds;
    }

    public function property($property)
    {
        $productIds = $this->products()->pluck('id');
        if ($property->type == 'text') {
            $value = ProductPropertyValue::whereIn('product_id', $productIds)
                ->join('product_properties', 'product_properties.id', 'product_properties_values.property_id')
                ->where('name', $property->name)->first();
            if ($value) {
                $value = $value->value;
            } else {
                $value = null;
            }
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

    public function images()
    {
        $imagesIds = $this->images ?: [];
        $images = Image::find($imagesIds);
        return $images ?: [(new Image(['url' => '/images/default.png']))];
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
