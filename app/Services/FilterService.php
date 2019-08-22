<?php

namespace App\Services;

use DB;
use App\Models\Product;
use App\Models\ProductPropertyValue;
use App\Services\Contracts\FilterServiceInterface;

class FilterService implements FilterServiceInterface
{
    public function getFilters($category = null)
    {
        if ($category)
            $productIds = $category->products()->pluck('id');
        else
            $productIds = Product::pluck('id');

        $filters = ProductPropertyValue::whereIn('product_id', $productIds)
            ->join('product_properties', 'product_properties.id', 'product_properties_values.property_id')
            ->orderBy('sort')
            ->pluck('type', 'name');
        
        foreach ($filters as $key => $value) {
            if ($value == 'text')
                $filters[$key] = $this->getCheckboxValues($productIds, $key);
            else
                $filters[$key] = $this->getRangeValues($productIds, $key);
            
        }

        return $filters;
    }

    protected function getCheckboxValues($productIds, $name)
    {
        $values = [
            'type' => 'text',
            'values' => []
        ];
        $values['values'] = ProductPropertyValue::whereIn('product_id', $productIds)
                ->join('product_properties', 'product_properties.id', 'product_properties_values.property_id')
                ->where('name', $name)
                ->pluck('value')
                ->toArray();
        return $values;
    }

    protected function getRangeValues($productIds, $name)
    {
        $values = [
            'type' => 'number',
            'values' => []
        ];
        $query = ProductPropertyValue::whereIn('product_id', $productIds)
            ->join('product_properties', 'product_properties.id', 'product_properties_values.property_id')
            ->where('name', $name);
        $values['values']['max'] = $query->max('int_value');
        $values['values']['min'] = $query->min('int_value');
        return $values['values']['min'] === $values['values']['max'] ?: $values;
    }
}
