<?php

namespace App\Models;

class WorkCategory extends BaseModel
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
            ],
            'meta_title',
            'meta_description',
            'meta_keywords'
        ];

        return $fields;
    }

    public function fullUrl()
    {
        $url = parent::fullUrl();
        $page = Page::where('behavior', 'portfolio')->first();
        return $page->url . $url;
    }

    public function works()
    {
        return $this->hasMany('App\Models\Work', 'category_id')->published();
    }
}
