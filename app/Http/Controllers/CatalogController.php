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
        return view('catalog.category', [
            'page' => $this->resource,
            'products' => Product::paginate(12)
        ]);
    }

    public function category($url)
    {
        $fullUrl = $this->resource->url . $url;
        $category = ProductCategory::where('url', $fullUrl)->published()->first();
        if (UserConfig::getProductsPerPageCount())
            $perPage = UserConfig::getProductsPerPageCount();
        else
            $perPage = 12;

        if (!$category && ($redirect = Redirect::getRedirect($fullUrl)))
            return redirect($redirect[0], $redirect[1]);

        if (!$category)
            abort(404, 'Страница не найдена');

        return view('catalog.category', [
            'page' => $category,
            'products' => $category->products()->published()->paginate($perPage),
            'perPage' => $perPage
        ]);
    }

    public function product()
    {
        return view('catalog.product', [
            'page' => Product::published()->first()
        ]);
    }
}
