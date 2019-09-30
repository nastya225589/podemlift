<?php

namespace Admin\Controllers;

use App\Models\FormQuestion;

class FormQuestionController extends BaseAdminController
{
    public function index()
    {
        $models = FormQuestion::orderBy('id', 'desc')->paginate(50);
        return view()->first(["admin.{$this->name}.index", "admin::{$this->name}.index", 'admin::base.index'], ['models' => $models]);
    }
}
