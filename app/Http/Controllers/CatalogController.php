<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Redirect;
use UserConfig;

class CatalogController extends Controller
{
    public function index()
    {
        $filters = $this->filterService->getFilters();
        return view('catalog.category', [
            'page' => $this->resource,
            'products' => Product::paginate(UserConfig::getProductsPerPageCount()),
            'filters' => $filters
        ]);
    }

    public function category($url)
    {
        $fullUrl = $this->resource->url . $url;
        $category = ProductCategory::where('url', $fullUrl)->published()->first();

        if (!$category && ($redirect = Redirect::getRedirect($fullUrl)))
            return redirect($redirect[0], $redirect[1]);

        if (!$category)
            abort(404, 'Страница не найдена');
        
        $filters = $this->filterService->getFilters($category);

        return view('catalog.category', [
            'page' => $category,
            'products' => $category->products()->published()->paginate(UserConfig::getProductsPerPageCount()),
            'filters' => $filters
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
