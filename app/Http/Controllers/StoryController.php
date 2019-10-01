<?php

namespace App\Http\Controllers;

use App\Models\Story;

class StoryController extends Controller
{
    public function one($slug)
    {
        return view('page.story-card', [
            'page' => Story::where('slug', $slug)->published()->firstOrFail(),
        ]);
    }
}
