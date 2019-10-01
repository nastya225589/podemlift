<?php

namespace App\Http\Controllers;

use App\Models\Work;

class WorkController extends Controller
{
    public function one($slug)
    {
        return view('page.portfolio-card', [
            'page' => Work::where('slug', $slug)->published()->firstOrFail()
        ]);
    }
}
