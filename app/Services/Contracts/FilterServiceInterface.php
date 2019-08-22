<?php

namespace App\Services\Contracts;

interface FilterServiceInterface
{
    public function getFilters($category = null);
}
