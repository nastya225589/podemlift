<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function getService($slug)
    {
        return view('page.services-item', [
            'page' => Service::where('slug', $slug)->first()
        ]);
    }
}
