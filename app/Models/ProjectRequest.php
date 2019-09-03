<?php

namespace App\Models;

use App\Models\Settings;

class ProjectRequest extends BaseModel
{
    protected $guarded = ['created_at', 'updated_at', 'g-recaptcha-response'];

    public function validatorRules($data)
    {
        $rules = [
            'firstname' => 'required|string|max:255',
            'phone' => 'required|string|max:255'
        ];

        $googleRecaptchaSecret = Settings::where('name', 'GOOGLE_RECAPTCHA_SECRET')->first();
        $googleRecaptchaKey = Settings::where('name', 'GOOGLE_RECAPTCHA_KEY')->first();
        
        if ($googleRecaptchaSecret->value && $googleRecaptchaKey->value) {
            $rules = array_merge($rules, ['g-recaptcha-response' => 'required|recaptcha']);
        }

        return $rules;
    }
}
