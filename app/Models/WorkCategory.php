<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkCategory extends Model
{
    use \Admin\Models\Traits\Sluggable;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'published',
        'sort',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

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

    public function childrens()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->orderBy('sort');
    }
}
