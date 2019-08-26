<?php

namespace App\Models;

class ProductPropertyValue extends BaseModel
{
    protected $table = 'product_properties_values';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function property()
    {
        return $this->belongsTo(ProductProperty::class, 'property_id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
