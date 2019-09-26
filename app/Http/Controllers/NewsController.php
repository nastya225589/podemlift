<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Page;

class NewsController extends Controller
{
    public function one($slug)
    {
        return view('page.new-card', [
            'page' => News::where('slug', $slug)->published()->firstOrFail(),
        ]);
    }
}
