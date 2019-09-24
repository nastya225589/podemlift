<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function store(Request $request)
    {
        $questionnaire = new Questionnaire;
        $request->validate($questionnaire->validatorRules($request));
        $questionnaire->create($request->all());
        return back()->with('sended', true);
    }
}
