<?php

namespace App\Models;

class FormQuestion extends BaseModel
{
    protected $guarded = ['created_at', 'updated_at', 'g-recaptcha-response'];

    public function validatorRules($data)
    {
        $rules = [
            'phone' => 'required|string|max:255'
        ];

        $googleRecaptchaSecret = config('settings')->GOOGLE_RECAPTCHA_SECRET;
        $googleRecaptchaKey = config('settings')->GOOGLE_RECAPTCHA_KEY;
        
        if ($googleRecaptchaSecret && $googleRecaptchaKey) {
            $rules = array_merge($rules, ['g-recaptcha-response' => 'required|recaptcha']);
        }

        return $rules;
    }
}
