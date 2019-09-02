<?php

use App\Models\Settings;
use Illuminate\Database\Migrations\Migration;

class AddCaptchaToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Settings::create([
            'name' => 'GOOGLE_RECAPTCHA_KEY',
            'label' => 'GOOGLE_RECAPTCHA_KEY',
            'group' => 'GOOGLE_RECAPTCHA',
            'type' => 'input',
            'sort' => '',
            'value' => '',
        ]);

        Settings::create([
            'name' => 'GOOGLE_RECAPTCHA_SECRET',
            'label' => 'GOOGLE_RECAPTCHA_SECRET',
            'group' => 'GOOGLE_RECAPTCHA',
            'type' => 'input',
            'sort' => '',
            'value' => '',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Settings::where('group', 'GOOGLE_RECAPTCHA')->delete();
    }
}
