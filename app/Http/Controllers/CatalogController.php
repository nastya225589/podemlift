<?php

namespace App\Http\Controllers;

use App\Models\SeoData;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductProperty;
use App\Models\Redirect;
use Illuminate\Http\Request;
use UserConfig;

class CatalogController extends Controller
{
    public $urlProperty = null;
    public $urlPropertyValue = null;

    public function index(Request $request)
    {
        $params = $request->all();

        if (count($params)) {
            $products = $this->filterService->filter($params)->published()->paginate(UserConfig::getProductsPerPageCount());
        } else {
            $products = Product::published()->paginate(UserConfig::getProductsPerPageCount());
        }

        $filters = $this->filterService->getFilters();

        return view('catalog.category', [
            'page' => $this->resource,
            'products' => $products,
            'filters' => $filters
        ]);
    }

    public function product($url)
    {
        $fullUrl = $this->resource->prefix . '/' . $url;
        $product = Product::where('url', $fullUrl)->published()->first();
        if (!$product && ($redirect = Redirect::getRedirect($fullUrl))) {
            return redirect($redirect[0], $redirect[1]);
        }

        if (!$product) {
            abort(404, 'Страница не найдена');
        }

        return view('catalog.product', [
            'product' => $product
        ]);
    }

    public function category($url, Request $request)
    {
        $params = $request->all();
        $fullUrl = $this->resource->url . $url;
        $category = $this->getCategory($fullUrl);
        
        if (get_class($category) === 'Illuminate\Http\RedirectResponse')
            return $category;

        if ($this->urlProperty && $this->urlPropertyValue) {
            $products = $this->filterService->filterSingle($this->urlProperty->slug, $this->urlPropertyValue);
            $resetFiltersUrl = $this->resource->url . $this->withoutParametrizedUrl($url);
            if ($category) {
                $seoData = $category->seoData()->where('url', '/' . $this->urlProperty->slug . '/' . $this->urlPropertyValue)->first();
            } else {
                $seoData = SeoData::where([
                    ['product_category_id', null],
                    ['url', '/' . $this->urlProperty->slug . '/' . $this->urlPropertyValue]
                ])->first();
            }
        } elseif (count($params)) {
            $products = $this->filterService->filter($params, $category);
        } else {
            $products = $category->products();
        }

        return view('catalog.category', [
            'page' => $category ?? $this->resource,
            'products' => $products->published()->paginate(UserConfig::getProductsPerPageCount()),
            'filters' => $this->filterService->getFilters($category),
            'singleProperty' => $this->urlProperty->slug ?? null,
            'singleValue' => $this->urlPropertyValue ?? null,
            'resetFiltersUrl' => $resetFiltersUrl ?? null,
            'seoData' => $seoData ?? null
        ]);
    }

    protected function getCategory($url)
    {
        $withoutParametrizedUrl = $this->withoutParametrizedUrl($url);
        $category = ProductCategory::where('url', $url)->published()->first();
        if (!$category && $this->isParametrizedUrl($url)) {
            $category = ProductCategory::where('url', $withoutParametrizedUrl)->published()->first();
            
            if (!$category && count(explode('/', $withoutParametrizedUrl)) <= 2) {
                return null;
            }
        }

        if (!$category) {
            $redirect = $this->tryRedirect($url);
            if ($redirect)
                return $redirect;
        }

        if (!$category) {
            $redirect = $this->tryRedirect($withoutParametrizedUrl);
            if ($redirect)
                return $redirect;
        }

        if (!$category && $this->isParametrizedUrl($url) && count(explode('/', $withoutParametrizedUrl)) <= 2) {
            return null;
        }
            
        if (!$category) {
            abort(404, 'Страница не найдена');
        }

        return $category;
    }

    protected function tryRedirect($url)
    {
        if ($redirect = Redirect::getRedirect($url)) {
            return redirect($redirect[0], $redirect[1]);
        }
    }

    protected function isParametrizedUrl($url)
    {
        $url = explode('/', trim($url, '/'));
        
        if (count($url) <= 2) {
            return false;
        }

        $paramValueSlug = array_pop($url);
        $paramSlug = array_pop($url);

        $this->urlProperty = ProductProperty::where('slug', $paramSlug)->first();
        if (!$this->urlProperty) {
            return false;
        }

        $this->urlPropertyValue = $paramValueSlug;

        return true;
    }

    protected function withoutParametrizedUrl($url)
    {
        $url = explode('/', trim($url, '/'));
        array_splice($url, -2);
        return '/' . join('/', $url);
    }
}
