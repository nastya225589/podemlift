<?php

namespace App\Models;

class Story extends BaseModel
{
    public $category_ids = [];

    protected $guarded = ['created_at', 'updated_at'];

    public $logFields = [
        'url',
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
                'label' => 'Url (если пусто, то сгенерируется автоматически)'
            ],
            [
                'name' => 'image_id',
                'type' => 'image',
                'label' => 'Основное изображение'
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

    public function image()
    {
        return $this->belongsTo('App\Models\Image');
    }
}
