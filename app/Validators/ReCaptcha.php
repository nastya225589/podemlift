<?php

namespace App\Validators;

use App\Models\Settings;
use GuzzleHttp\Client;

class ReCaptcha
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $client = new Client;
        $googleRecaptchaSecret = Settings::where('name', 'GOOGLE_RECAPTCHA_SECRET')->first();
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                    [
                        'secret' => $googleRecaptchaSecret->value,
                        'response' => $value
                    ]
            ]
        );
        $body = json_decode((string)$response->getBody());
        return $body->success;
    }
}
