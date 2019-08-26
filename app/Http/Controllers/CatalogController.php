<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\Redirect;
use Illuminate\Http\Request;
use UserConfig;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->all();
        $redirectUrl = $this->getSinglePropertyRedirect($request->path(), $params);
        
        if ($redirectUrl)
            return redirect($redirectUrl);
        
        if (count($params))
            $products = $this->filterService->filter($params)->published()->paginate(UserConfig::getProductsPerPageCount());
        else
            $products = Product::published()->paginate(UserConfig::getProductsPerPageCount());

        $filters = $this->filterService->getFilters();

        return view('catalog.category', [
            'page' => $this->resource,
            'products' => $products,
            'filters' => $filters
        ]);
    }

    public function category($url, Request $request)
    {
        $params = $request->all();
        
        $fullUrl = $this->resource->url . $url;
        $category = ProductCategory::where('url', $fullUrl)->published()->first();

        if (!$category && ($redirect = Redirect::getRedirect($fullUrl)))
            return redirect($redirect[0], $redirect[1]);

        $property = explode('/', $url)[1];
        if (!$category && ProductProperty::where('slug', $property)->first()) {
            $value = explode('/', $url)[2];
            return $this->indexSingleFilter($property, $value, $request);
        }

        $redirectUrl = $this->getSinglePropertyRedirect($request->path(), $params);
        if ($redirectUrl)
            return redirect($redirectUrl);

        if (!$category)
            abort(404, 'Страница не найдена');
        
        $filters = $this->filterService->getFilters($category);

        if (count($params))
            $products = $this->filterService->filter($params, $category);
        else
            $products = $category->products();

        return view('catalog.category', [
            'page' => $category,
            'products' => $products->published()->paginate(UserConfig::getProductsPerPageCount()),
            'filters' => $filters
        ]);
    }

    public function indexSingleFilter($property, $value, Request $request)
    {
        $params = $request->all();

        if ($redirectUrl = $this->getSinglePropertyRedirect($this->resource->url, $params))
            return redirect($redirectUrl);
        
        if ($redirectUrl = $this->getMultiPropertyRedirect($request->getRequestUri(), null, $params))
            return redirect($redirectUrl);

        $filters = $this->filterService->getFilters();
        $products = $this->filterService->filterSingle($property, $value);
        return view('catalog.category', [
            'page' => $this->resource,
            'products' => $products->published()->paginate(UserConfig::getProductsPerPageCount()),
            'filters' => $filters,
            'singleProperty' => $property,
            'singleValue' => $value,
            'resetFiltersUrl' => $this->resource->url
        ]);
    }

    public function singleFilterCategory($url, $property, $value, Request $request)
    {
        $params = $request->all();

        if ($redirectUrl = $this->getSinglePropertyRedirect($this->resource->url . $url, $params))
            return redirect($redirectUrl);
        
        if ($redirectUrl = $this->getMultiPropertyRedirect($request->getRequestUri(), $url, $params))
            return redirect($redirectUrl);

        $fullUrl = $this->resource->url . $url;
        $category = ProductCategory::where('url', $fullUrl)->published()->first();

        if (!$category && ($redirect = Redirect::getRedirect($fullUrl)))
            return redirect($redirect[0], $redirect[1]);

        if (!$category)
            abort(404, 'Страница не найдена');
        
        $filters = $this->filterService->getFilters($category);
        $products = $this->filterService->filterSingle($property, $value, $category);
        return view('catalog.category', [
            'page' => $category,
            'products' => $products->published()->paginate(UserConfig::getProductsPerPageCount()),
            'filters' => $filters,
            'singleProperty' => $property,
            'singleValue' => $value,
            'resetFiltersUrl' => $fullUrl
        ]);
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->published()->firstOrFail();
        return view('catalog.product', [
            'product' => $product
        ]);
    }

    protected function getSinglePropertyRedirect($url, array $params)
    {
        if ($this->isSinglePropertyQuery($params)) {
            if (is_countable($params[array_key_first($params)]))
                return $url . '/' . array_key_first($params) . '/' . $params[array_key_first($params)][0];
            else
                return $url . '/' . array_key_first($params) . '/' . $params[array_key_first($params)];
        }
    }

    protected function getMultiPropertyRedirect($requestUri, $url, array $params)
    {
        if ($this->isMultyPropertyQuery($params)) {
            $queryString = explode('?', $requestUri)[1];
            return $this->resource->url . $url . '?' . $queryString;
        }
    }

    protected function isSinglePropertyQuery($params)
    {
        if (count($params) === 1 
            && array_key_first($params) !== 'page' 
            && is_countable($params[array_key_first($params)]) 
            && count($params[array_key_first($params)]) === 1)
            return true;
        elseif (count($params) === 1
            && !is_countable($params[array_key_first($params)]))
            return true;
    }

    protected function isMultyPropertyQuery($params)
    {
        if (count($params) > 1)
            return true;
        elseif (count($params) && is_countable($params[array_key_first($params)]) && count($params[array_key_first($params)]) > 1)
            return true;
    }
}
