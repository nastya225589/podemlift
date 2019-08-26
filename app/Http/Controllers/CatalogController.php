<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Redirect;
use Illuminate\Http\Request;
use UserConfig;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->all();
        
        if (count($params))
            $products = $this->filterService->filter($params)->paginate(UserConfig::getProductsPerPageCount());
        else
            $products = Product::paginate(UserConfig::getProductsPerPageCount());

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
        $redirectUrl = $this->filterService->getSinglePropertyRedirect($request->path(), $params);
        if ($redirectUrl)
            return redirect($redirectUrl);
        
        $fullUrl = $this->resource->url . $url;
        $category = ProductCategory::where('url', $fullUrl)->published()->first();

        if (!$category && ($redirect = Redirect::getRedirect($fullUrl)))
            return redirect($redirect[0], $redirect[1]);

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

    public function singleFilterCategory($url, $property, $value, Request $request)
    {
        $params = $request->all();

        $redirectUrl = $this->filterService->getSinglePropertyRedirect($this->resource->url . $url, $params);
        if ($redirectUrl)
            return redirect($redirectUrl);
        elseif (count($params) > 1 || (count($params) && is_countable($params[array_key_first($params)]) && count($params[array_key_first($params)]) > 1)) {
            $queryString = explode('?', $request->getRequestUri())[1];
            return redirect($this->resource->url . $url . '?' . $queryString);
        }

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
            'singleValue' => $value
        ]);
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->published()->firstOrFail();
        return view('catalog.product', [
            'product' => $product
        ]);
    }
}
