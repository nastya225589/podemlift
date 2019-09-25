<?php

use App\Models\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailsToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Settings::where('name', 'email')->update([
            'label' => 'Адрес входящей электронной почты'
        ]);

        Settings::create([
            'name' => 'email_clients',
            'label' => 'Адрес электронной почты для заказчиков',
            'group' => 'Контакты',
            'type' => 'input',
            'sort' => 0,
            'value' => '',
        ]);

        Settings::create([
            'name' => 'email_suppliers',
            'label' => 'Адрес электронной почты для поставщиков',
            'group' => 'Контакты',
            'type' => 'input',
            'sort' => 0,
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
        Settings::where('name', 'email_suppliers')->delete();
        Settings::where('name', 'email_clients')->delete();
        Settings::where('name', 'email')->update([
            'label' => 'Адрес электронной почты'
        ]);
    }
}
