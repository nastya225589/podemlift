<?php

namespace App\Http\Controllers;

use \Admin\Models\Page;
use \Admin\Models\Redirect;
use \App\Models\Product;
use \App\Models\Service;

class PageController extends Controller
{
    public function index()
    {
        $page = Page::where('behavior', 'main')->first();
        $products = Product::all();
        $services = Service::inRandomOrder()->get();

        return view('page.index', [
            'page' => $page,
            'products' => $products,
            'services' => $services
        ]);
    }

    public function show($url)
    {
        $url = '/' . $url;
        $page = Page::where(['published' => 1, 'url' => $url])->first();

        if (!$page && ($redirect = Redirect::getRedirect($url)))
            return redirect($redirect[0], $redirect[1]);

        if (!$page)
            abort(404, 'Страница не найдена');

        return view('page.show', ['page' => $page]);
    }
}
