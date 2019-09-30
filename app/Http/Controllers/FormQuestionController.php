<?php

namespace App\Http\Controllers;

use App\Models\FormQuestion;
use Illuminate\Http\Request;

class FormQuestionController extends Controller
{
    public function store(Request $request)
    {
        $formQuestion = new FormQuestion;
        $request->validate($formQuestion->validatorRules($request));
        $formQuestion->create($request->all());
        return back()->with('sended', true);
    }
}
