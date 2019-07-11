<?php

namespace App\Models;

use Admin\Models\Model;

class WorkCategory extends Model
{
    public $logFields = [
        'parent_id',
        'name',
        'slug',
        'published',
        'sort',
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
            ]
        ];

        return $fields;
    }
}
