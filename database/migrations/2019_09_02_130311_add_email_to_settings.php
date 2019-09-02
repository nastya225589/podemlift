<?php

use App\Models\Settings;
use Illuminate\Database\Migrations\Migration;

class AddEmailToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Settings::create([
            'name' => 'email',
            'label' => 'Адрес электронной почты',
            'group' => 'Контакты',
            'type' => 'input',
            'sort' => 10,
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
        Settings::where('name', 'email')->delete();
    }
}
