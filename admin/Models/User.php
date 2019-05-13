<?php

namespace Admin\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Validation\Rule;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function formFields()
    {
        return[
            ['name' => 'name', 'type' => 'input', 'label' => 'Имя'],
            ['name' => 'email', 'type' => 'email', 'label' => 'Email'],
            ['name' => 'password', 'type' => 'input', 'label' => 'Пароль'],
        ];
    }

    public function validatorRules($data)
    {
        return [
            'name' => 'required|string|max:255',
            'password' => $this->id && empty($data['password']) ? 'nullable' : 'required|string|min:6',
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($this->id)
            ],
        ];
    }

}
