<?php

namespace Admin\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
        $settings = (object) DB::table('settings')->get()->pluck('value', 'name')->toArray();

        config(['settings' => $settings]);

        $config = [
            'driver' => 'smtp',
            'host' => $settings->smtp_host ?? '',
            'port' => $settings->smtp_port ?? '',
            'from' => [
                'address' => $settings->smtp_email_from ?? '',
                'name' => $settings->smtp_email_from_name ?? '',
            ],
            'encryption' => $settings->smtp_encryption ?? '',
            'username' => $settings->smtp_login ?? '',
            'password' => $settings->smtp_password ?? ''
        ];

        Config::set('mail', $config);
    }
}
