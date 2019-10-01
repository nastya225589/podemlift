<?php

namespace App\Http\Controllers;

use App\Models\ApplicationSphere;

class SphereController extends Controller
{
    public function one($slug)
    {
        return view('page.sphere-item', [
            'page' => ApplicationSphere::where('slug', $slug)->published()->firstOrFail()
        ]);
    }
}
