<?php

namespace App\Http\Controllers;

use \App\Models\Page;
use \App\Models\Redirect;

class PageController extends Controller
{
    public function index()
    {
        $page = Page::where('behavior', 'main')->first();

        return view('page.index', [
            'page' => $page
        ]);
    }

    public function show($url)
    {
        $url = '/' . $url;
        $page = Page::where('url', $url)->published()->first();
        if (!$page && ($redirect = Redirect::getRedirect($url))) {
            return redirect($redirect[0], $redirect[1]);
        }

        if (!$page) {
            abort(404, 'Страница не найдена');
        }

        $view = 'page.show';
        if ($page->behavior)
            $view = 'page.' . $page->behavior;

        return view($view, ['page' => $page]);
    }
}
