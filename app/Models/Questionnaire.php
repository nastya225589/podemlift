<?php

namespace App\Models;

use App\Models\Settings;

class Questionnaire extends BaseModel
{
    protected $guarded = ['created_at', 'updated_at', 'g-recaptcha-response'];

    protected $casts = [
        'load_method' => 'array'
    ];

    public function validatorRules($data)
    {
        $rules = [
            'firstname' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|regex:/^.+@.+$/i',
            'mailing_address' => 'string|max:255',
            'delivery_at' => 'date|date_format:"d.m.Y"',
            'delivery' => 'string|max:255',
            'carrying' => 'integer',
            'lift' => 'integer',
            'type_of_lift' => 'string|max:255',
            'place' => 'string|max:255',
            'number_of_stops' => 'string|max:255',
            'load_method' => 'array',
            'load_method.*' => 'string|max:255',
            'type_of_platform' => 'string|max:255',
            'tailgate' => 'boolean',
            'swing_doors' => 'boolean',
            'signaling' => 'boolean',
            'additionally' => 'string'
        ];

        $googleRecaptchaSecret = Settings::where('name', 'GOOGLE_RECAPTCHA_SECRET')->first();
        $googleRecaptchaKey = Settings::where('name', 'GOOGLE_RECAPTCHA_KEY')->first();
        
        if ($googleRecaptchaSecret->value && $googleRecaptchaKey->value) {
            $rules = array_merge($rules, ['g-recaptcha-response' => 'required|recaptcha']);
        }

        return $rules;
    }

    public function getLoadMethodAttribute($value)
    {
        return json_decode($value);
    }
}
