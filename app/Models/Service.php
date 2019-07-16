<?php

namespace App\Models;

use App\Models\Model;

class Service extends Model
{
    public $logFields = [
        'name',
        'published',
        'category_id',
        'slug',
        'introtext',
        'text',
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
                'name' => 'category_id',
                'type' => 'select',
                'label' => 'Категория',
                'options' => ServiceCategory::pluck('name', 'id')
            ],
            [
                'name' => 'on_main',
                'type' => 'checkbox',
                'label' => 'Выводить на главной'
            ],
            [
                'name' => 'order_on_main',
                'type' => 'input',
                'label' => 'Сортировка на главной'
            ],
            [
                'name' => 'text_on_main',
                'type' => 'textarea',
                'label' => 'Текст на главной'
            ],
            [
                'name' => 'introtext',
                'type' => 'textarea',
                'label' => 'Текст превью'
            ],
            [
                'name' => 'text',
                'type' => 'editor',
                'label' => 'Текст'
            ],
            'meta_title',
            'meta_description',
            'meta_keywords'
        ];

        return $fields;
    }
}
