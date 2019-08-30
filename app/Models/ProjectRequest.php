<?php

namespace App\Models;

class ProjectRequest extends BaseModel
{
    protected $guarded = ['created_at', 'updated_at'];

    public function validatorRules($data)
    {
        return [
            'firstname' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ];
    }
}
