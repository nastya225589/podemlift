<?php

use App\Models\Settings;
use Illuminate\Database\Migrations\Migration;

class ToLowerCaseInSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Settings::where('name', 'GOOGLE_RECAPTCHA_SECRET')->update([
            'name' => 'google_recaptcha_secret'
        ]);
        Settings::where('name', 'GOOGLE_RECAPTCHA_KEY')->update([
            'name' => 'google_recaptcha_key'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Settings::where('name', 'google_recaptcha_secret')->update([
            'name' => 'GOOGLE_RECAPTCHA_SECRET'
        ]);
        Settings::where('name', 'google_recaptcha_key')->update([
            'name' => 'GOOGLE_RECAPTCHA_KEY'
        ]);
    }
}
