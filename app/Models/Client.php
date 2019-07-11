<?php

namespace App\Models;

use Admin\Models\Model;

class Client extends Model
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
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
