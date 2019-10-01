<?php

namespace App\Services\Contracts;

interface FilterServiceInterface
{
    public function getFilters($category = null);

    public function getValues($category);

    public function filter(array $params);
}
