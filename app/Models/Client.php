<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Admin\Models\Image;

class Client extends Model
{
    use \Admin\Models\Traits\Sluggable;

    protected $fillable = [
        'name',
        'published',
        'image_id'
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

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
