<?php

namespace Admin\Controllers;

use App\Models\Questionnaire;

class QuestionnaireController extends BaseAdminController
{
    public function index()
    {
        $models = Questionnaire::orderBy('id', 'desc')->paginate(50);
        return view()->first(["admin.{$this->name}.index", "admin::{$this->name}.index", 'admin::base.index'], ['models' => $models]);
    }
}
