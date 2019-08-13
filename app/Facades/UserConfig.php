<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UserConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'userconfig';
    }
}
