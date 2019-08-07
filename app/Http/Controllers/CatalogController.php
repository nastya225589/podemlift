<?php

namespace App\Http\Controllers;

class CatalogController extends Controller
{
    public function index()
    {
        return view('catalog.category', [
            'page' => $this->resource
        ]);
    }

    public function show($url)
    {
        return view('catalog.product', [
            'page' => $this->resource
        ]);
    }
}
