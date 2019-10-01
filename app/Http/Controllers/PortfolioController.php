<?php

namespace App\Http\Controllers;

use App\Models\WorkCategory;

class PortfolioController extends Controller
{
    public function one($slug)
    {
        return view('page.portfolio-item', [
            'page' => WorkCategory::where('slug', $slug)->published()->firstOrFail()
        ]);
    }
}
