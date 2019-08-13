<?php

namespace App\Helpers;

use Cookie;

class UserConfigHelper
{
    public function getCatalogListingType()
    {
        return Cookie::get('shorting_view_type');
    }
}
