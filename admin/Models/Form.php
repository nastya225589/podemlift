<?php

namespace Admin\Models;

use Illuminate\Database\Eloquent\Model;

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
}
