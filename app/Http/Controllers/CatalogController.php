<?php

namespace App\Http\Controllers;

use App\Models\{ProductCategory, Product, Redirect};

class CatalogController extends Controller
{
    public function index()
    {
        return view('catalog.category', [
            'page' => $this->resource
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

        return view('catalog.category', [
            'page' => $category
        ]);
    }

    public function product()
    {
        return view('catalog.product', [
            'page' => Product::published()->first()
        ]);
    }
}
