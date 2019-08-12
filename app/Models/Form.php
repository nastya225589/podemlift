<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Admin\Mail\FormSended;
use Illuminate\Support\Facades\Mail;

class Form extends Model
{
    protected $attributes = [
        'data' => '{}'
    ];

    protected $fillable = [
        'name', 'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            Mail::to(env('MAIL_TO'))
                ->send(new FormSended($model));
        });
    }
}
