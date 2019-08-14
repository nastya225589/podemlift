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
        return Cookie::get('products_per_page');
    }
}
