<?php

namespace App\Models;

class BackCall extends BaseModel
{
    protected $guarded = ['created_at', 'updated_at', 'g-recaptcha-response'];

    public function validatorRules($data)
    {
        $rules = [
            'firstname' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'nullable|string|max:255'
        ];

        return $rules;
    }
}
