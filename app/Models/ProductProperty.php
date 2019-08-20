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
                'name' => 'type',
                'type' => 'select',
                'label' => 'Тип',
                'options' => [
                    'text' => 'Текст',
                    'number' => 'Число'
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
        $value == '' ? $this->attributes['image_id'] = null : $this->attributes['image_id'] = $value;
    }
}
