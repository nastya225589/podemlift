<?php

use App\Models\Settings;
use Illuminate\Database\Migrations\Migration;

class AddMailSettingsToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Settings::create([
            'name' => 'smtp_host',
            'label' => 'SMTP host',
            'group' => 'SMTP',
            'type' => 'input',
            'sort' => 3,
            'value' => '',
        ]);

        Settings::create([
            'name' => 'smtp_port',
            'label' => 'SMTP port',
            'group' => 'SMTP',
            'type' => 'input',
            'sort' => 4,
            'value' => '',
        ]);

        Settings::create([
            'name' => 'smtp_email_from',
            'label' => 'Email исходящей почты',
            'group' => 'SMTP',
            'type' => 'input',
            'sort' => 5,
            'value' => '',
        ]);

        Settings::create([
            'name' => 'smtp_email_from_name',
            'label' => 'Имя пользователя исходящей почты',
            'group' => 'SMTP',
            'type' => 'input',
            'sort' => 6,
            'value' => '',
        ]);

        Settings::create([
            'name' => 'smtp_encryption',
            'label' => 'Шифрование',
            'group' => 'SMTP',
            'type' => 'input',
            'sort' => 7,
            'value' => '',
        ]);

        Settings::create([
            'name' => 'smtp_login',
            'label' => 'Логин пользователя для отправки писем',
            'group' => 'SMTP',
            'type' => 'input',
            'sort' => 8,
            'value' => '',
        ]);

        Settings::create([
            'name' => 'smtp_password',
            'label' => 'Пароль пользователя для отправки писем',
            'group' => 'SMTP',
            'type' => 'input',
            'sort' => 9,
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
        Settings::where('group', 'SMTP')->delete();
    }
}
