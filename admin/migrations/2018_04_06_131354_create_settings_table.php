<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Settings;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('label');
            $table->string('group');
            $table->string('type');
            $table->string('sort');
            $table->text('value');
        });

        Settings::create([
            'name' => 'phone',
            'group' => 'Контакты',
            'label' => 'Телефон',
            'type' => 'input',
            'sort' => 1,
            'value' => '8 800 900 20 20'
        ]);
        Settings::create([
            'name' => 'address',
            'group' => 'Контакты',
            'label' => 'Адрес',
            'type' => 'input',
            'sort' => 2,
            'value' => 'NewYork'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
