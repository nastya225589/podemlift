<?php

namespace App\Http\Controllers;

use App\Models\ProjectRequest;
use Illuminate\Http\Request;

class RequestFormController extends Controller
{
    public function store(Request $request)
    {
        $projectRequest = new ProjectRequest;
        $request->validate($projectRequest->validatorRules($request));
        $projectRequest->create($request->all());
        return back()->with('sended', true);
    }
}
