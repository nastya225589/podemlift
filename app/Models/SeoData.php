<?php

namespace App\Models;

class SeoData extends BaseModel
{
    public $category_ids = [];

    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'published' => 'boolean',
        'category_id' => 'integer'
    ];

    public $logFields = [
        'product_category_id',
        'url',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    public function formFields()
    {
        $fields = [
            [
                'name' => 'product_category_id',
                'type' => 'select',
                'options' => ProductCategory::pluck('name', 'id'),
                'data_placeholder' => 'Без категории',
                'multi' => false,
                'label' => 'Категория'
            ],
            [
                'name' => 'url',
                'type' => 'input',
                'label' => 'Url'
            ],
            'meta_title',
            'meta_description',
            'meta_keywords'
        ];

        return $fields;
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function setProductCategoryIdAttribute($value)
    {
        if (!$value)
            $this->attributes['product_category_id'] = null;
        else
            $this->attributes['product_category_id'] = $value;
    }

    public function validatorRules($data)
    {
        return [
            'url' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
        ];
    }
}
