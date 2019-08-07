<?php

namespace App\Models;

class Client extends BaseModel
{
    public $logFields = [
        'name',
        'published',
        'image_id'
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
                'name' => 'image_id',
                'type' => 'image',
                'label' => 'Картинка'
            ]
        ];

        return $fields;
    }

    public function image()
    {
        return $this->hasOne(\App\Models\Image::class, 'id', 'image_id');
    }
}
