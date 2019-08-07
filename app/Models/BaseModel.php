<?php

namespace App\Models;

use \App\Models\Traits\{Log, Publish, Nested, Sort, Url, Columns};

class BaseModel extends \Illuminate\Database\Eloquent\Model
{
    use Log, Publish, Nested, Sort, Url, Columns;

    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'published' => 'boolean',
    ];
}
