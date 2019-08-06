<?php

namespace App\Models;

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

    public function fullUrl()
    {
        $url = parent::fullUrl();
        $page = Page::where('behavior', 'works')->first();
        return $page->url . $url;
    }
}
