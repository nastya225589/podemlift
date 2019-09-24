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
            'email' => 'nullable|regex:/^.+@.+$/i',
            'mailing_address' => 'nullable|string|max:255',
            'delivery_at' => 'nullable|date|date_format:"d.m.Y"',
            'delivery' => 'nullable|string|max:255',
            'carrying' => 'nullable|integer',
            'lift' => 'nullable|integer',
            'type_of_lift' => 'nullable|string|max:255',
            'place' => 'nullable|string|max:255',
            'number_of_stops' => 'nullable|string|max:255',
            'load_method' => 'array',
            'load_method.*' => 'nullable|string|max:255',
            'type_of_platform' => 'nullable|string|max:255',
            'tailgate' => 'boolean',
            'swing_doors' => 'boolean',
            'signaling' => 'boolean',
            'additionally' => 'nullable|string'
        ];

        $googleRecaptchaSecret = Settings::where('name', 'GOOGLE_RECAPTCHA_SECRET')->first();
        $googleRecaptchaKey = Settings::where('name', 'GOOGLE_RECAPTCHA_KEY')->first();
        
        if ($googleRecaptchaSecret->value && $googleRecaptchaKey->value) {
            $rules = array_merge($rules, ['g-recaptcha-response' => 'required|recaptcha']);
        }

        return $rules;
    }

    public function setDeliveryAtAttribute($value)
    {
        $this->attributes['delivery_at'] = $value ? $value : null;
    }

    public function getLoadMethodAttribute($value)
    {
        return json_decode($value);
    }
}
