<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\ProductProperty;
use App\Models\Redirect;
use Illuminate\Http\Request;
use UserConfig;

class CatalogController2 extends Controller
{
    public $urlProperty = null;
    public $urlPropertyValue = null;

    public function category($url, Request $request)
    {
        $params = $request->all();
        $fullUrl = $this->resource->url . $url;
        $category = $this->getCategory($fullUrl);

        if ($this->urlProperty && $this->urlPropertyValue) {
            $products = $this->filterService->filterSingle($this->urlProperty->slug, $this->urlPropertyValue);
            $resetFiltersUrl = $this->resource->url . $this->withoutParametrizedUrl($url);
        }
        else if (count($params))
            $products = $this->filterService->filter($params, $category);
        else
            $products = $category->products();

        return view('catalog.category', [
            'page' => $this->resource,
            'products' => $products->published()->paginate(UserConfig::getProductsPerPageCount()),
            'filters' => $this->filterService->getFilters(),
            'singleProperty' => $this->urlProperty->slug ?? null,
            'singleValue' => $this->urlPropertyValue ?? null,
            'resetFiltersUrl' => $resetFiltersUrl ?? null
        ]);
    }

    public function getCategory($url)
    {
        $withoutParametrizedUrl = $this->withoutParametrizedUrl($url);
        $category = ProductCategory::where('url', $url)->published()->first();
        if (!$category && $this->isParametrizedUrl($url)){
            $category = ProductCategory::where('url', $withoutParametrizedUrl)->published()->first();
            
            if (!$category && count(explode('/', $withoutParametrizedUrl)) <= 2)
                return null;
        }

        if (!$category)
            $this->tryRedirect($url);

        if (!$category)
            $this->tryRedirect($withoutParametrizedUrl);

        if (!$category && $this->isParametrizedUrl($url) && count(explode('/', $withoutParametrizedUrl)) <= 2)
            return null;
            
        if (!$category)
            abort(404, 'Страница не найдена');

        return $category;
    }

    public function tryRedirect($url)
    {
        if ($redirect = Redirect::getRedirect($url)) {
            redirect($redirect[0], $redirect[1]);
            die();
        }
    }

    public function isParametrizedUrl($url)
    {
        $url = explode('/', trim($url, '/'));
        // /catalog/cvet/belyi
        if (count($url) <= 2)
            return false;

        $paramValueSlug = array_pop($url);
        $paramSlug = array_pop($url);

        $this->urlProperty = ProductProperty::where('slug', $paramSlug)->first();
        if (!$this->urlProperty)
            return false;

        $this->urlPropertyValue = $paramValueSlug;

        return true;
    }

    public function withoutParametrizedUrl($url)
    {
        $url = explode('/', trim($url, '/'));
        array_splice($url, -2);
        return '/' . join('/', $url);
    }
}
