<?php

namespace App\Models;

class ProductProperty extends BaseModel
{
    public $logFields = [
        'parent_id',
        'name',
        'slug'
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
                'name' => 'slug',
                'type' => 'input',
                'label' => 'Url'
            ],
            [
                'name' => 'is_additional',
                'type' => 'checkbox',
                'label' => 'Дополнительный параметр'
            ],
            [
                'name' => 'type',
                'type' => 'select',
                'label' => 'Тип',
                'options' => [
                    'text' => 'Текст',
                    'number' => 'Число',
                    'range' => 'Диапозон'
                ]
            ],
            [
                'name' => 'image_id',
                'type' => 'image',
                'label' => 'Картинка'
            ],
            [
                'name' => 'measure',
                'type' => 'input',
                'label' => 'Единица измерения'
            ]
        ];

        return $fields;
    }

    public function setImageIdAttribute($value)
    {
        $value == $this->attributes['image_id'] = $value ?: null;
    }

    public function values()
    {
        return $this->hasMany(ProductPropertyValue::class, 'property_id', 'id');
    }
}
