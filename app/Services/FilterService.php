<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\ProductPropertyValue;
use App\Services\Contracts\FilterServiceInterface;

class FilterService implements FilterServiceInterface
{
    public function getFilters($category = null)
    {
        if ($category) {
            $productIds = $category->products()->pluck('id');
            $properties = $category->properties;
        } else {
            $productIds = Product::pluck('id');
        }

        if (isset($properties) && count($properties)) {
            $filters = $category
                ->properties()
                ->select('type', 'name', 'slug')
                ->orderBy('sort')
                ->get()->toArray();
        } else {
            $filters = ProductPropertyValue::whereIn('product_id', $productIds)
                ->join('product_properties', 'product_properties.id', 'product_properties_values.property_id')
                ->select('type', 'name', 'slug')
                ->orderBy('sort')
                ->groupBy('type', 'name', 'slug', 'sort')
                ->get()->toArray();
        }

        foreach ($filters as $key => $filter) {
            if ($filter['type'] == 'text') {
                $filters[$key]['values'] = $this->getCheckboxValues($productIds, $filter['name']);
            } else {
                $filters[$key]['values'] = $this->getRangeValues($productIds, $filter['name']);
            }
        }
        return $filters;
    }

    public function getValues($category)
    {
        $productIds = $category->products()->pluck('id');
        $properties = $category->properties;
        if (count($properties)) {
            $values = $category
                ->properties()
                ->where('type', 'number')
                ->select('name')
                ->orderBy('sort')
                ->get()->toArray();
        } else {
            $values = ProductPropertyValue::whereIn('product_id', $productIds)
                ->join('product_properties', 'product_properties.id', 'product_properties_values.property_id')
                ->where('type', 'number')
                ->select('name')
                ->orderBy('sort')
                ->groupBy('name', 'sort')
                ->get()->toArray();
        }

        foreach ($values as $key => $filter) {
            $values[$key]['values'] = $this->getRangeValues($productIds, $filter['name']);
        }
        return $values;
    }

    public function filter(array $params, $category = null)
    {
        if ($category) {
            $query = $category->products();
        } else {
            $query = Product::query();
        }

        foreach ($params as $key => $value) {
            if ($key !== 'page') {
                $this->queryByFilter($key, $value, $query);
            }
        }
        return $query;
    }

    public function filterSingle($property, $value, $category = null)
    {
        if ($category) {
            $query = $category->products();
        } else {
            $query = Product::query();
        }
        
        $values[] = $value;
        $this->queryByFilter($property, $values, $query);
        return $query;
    }

    protected function queryByFilter($filterName, $value, $query)
    {
        $type = ProductProperty::select('type')->where('slug', $filterName)->pluck('type');
        if (count($type)) {
            $type = $type[0];
        } else {
            return;
        }

        if ($type === 'text') {
            $query = $query->whereHas('properties.property', function ($query) use ($filterName, $value) {
                $query->where('slug', $filterName)->whereIn('value_slug', $value);
            });
        } elseif ($type === 'number') {
            $query = $query->whereHas('properties.property', function ($query) use ($filterName, $value) {
                $query->where([
                    ['slug', $filterName],
                    ['int_value', '<=', $value]
                ]);
            });
        }
    }

    protected function getCheckboxValues($productIds, $name)
    {
        $values = ProductPropertyValue::whereIn('product_id', $productIds)
                ->join('product_properties', 'product_properties.id', 'product_properties_values.property_id')
                ->where('name', $name)
                ->pluck('value', 'value_slug')
                ->toArray();
        return $values;
    }

    protected function getRangeValues($productIds, $name)
    {
        $values = [];
        $query = ProductPropertyValue::whereIn('product_id', $productIds)
            ->join('product_properties', 'product_properties.id', 'product_properties_values.property_id')
            ->where('name', $name);
        $values['max'] = $query->max('int_value');
        $values['min'] = $query->min('int_value');
        $values['measure'] = $query->pluck('measure')[0];
        return $values;
    }
}
