<?php

namespace App\Helpers;

use Cookie;

class UserConfigHelper
{
    public function catalogListingInline()
    {
        if (Cookie::get('shorting_view_type') == 'line')
            return true;
        else
            return false;
    }

    public function getProductsPerPageCount()
    {
        $default = 12;
        $perPage = Cookie::get('products_per_page');
        if (in_array(intval($perPage), [12, 24, 36]))
            return $perPage;
        else
            return $default;
    }
}
