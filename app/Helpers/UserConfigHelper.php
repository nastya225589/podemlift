<?php

namespace App\Helpers;

use Cookie;

class UserConfigHelper
{
    public function catalogListingInline()
    {
        if (Cookie::get('shorting_view_type') == 'line') {
            return true;
        } else {
            return false;
        }
    }
}
