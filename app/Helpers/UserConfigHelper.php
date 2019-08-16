<?php

namespace App\Helpers;

use Cookie;

class UserConfigHelper
{
    public function catalogListingInline()
    {
        return Cookie::get('shorting_view_type') === 'line';
    }

    public function getProductsPerPageCount()
    {
        $default = 12;
        $perPage = Cookie::get('products_per_page');
        return in_array(intval($perPage), [12, 24, 36]) ? $perPage : $default;
    }
}
