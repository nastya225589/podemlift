<?php

namespace App\Http\Controllers;

use \Admin\Models\Page;
use \Admin\Models\Redirect;
use \App\Models\Product;
use \App\Models\Service;
use \App\Models\Work;
use \App\Models\Client;

class PageController extends Controller
{
    public function index()
    {
        $page = Page::where('behavior', 'main')->first();
        $products = Product::all();
        $services = Service::inRandomOrder()->limit(4)->get();

        $works = Work::inRandomOrder()->limit(10)->get();
        while ($works->count() < 5) {
            $more = Work::inRandomOrder()->limit(10)->get();
            $works = collect(array_merge($works->all(), $more->all()));
        }

        $clients = Client::inRandomOrder()->limit(10)->get();
        while ($clients->count() < 14) {
            $more = Client::inRandomOrder()->limit(10)->get();
            $clients = collect(array_merge($clients->all(), $more->all()));
        }

        return view('page.index', [
            'page' => $page,
            'products' => $products,
            'services' => $services,
            'works' => $works,
            'clients' => $clients
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
