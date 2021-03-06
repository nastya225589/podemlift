<?php

namespace App\Models;

use \App\Models\Traits\Log;
use \App\Models\Traits\Publish;
use \App\Models\Traits\Nested;
use \App\Models\Traits\Sort;
use \App\Models\Traits\Url;
use \App\Models\Traits\Columns;

class BaseModel extends \Illuminate\Database\Eloquent\Model
{
    use Log, Publish, Nested, Sort, Url, Columns;

    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function validatorRules($data)
    {
        return [
            'name' => 'required|string|max:255',
            'published' => 'boolean',
            'slug' => 'nullable|string|max:255',
            'fields' => 'array',
            'images' => 'array',
        ];
    }
}
