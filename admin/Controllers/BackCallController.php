<?php

namespace Admin\Controllers;

use App\Models\BackCall;

class BackCallController extends BaseAdminController
{
    public function index()
    {
        $models = BackCall::orderBy('id', 'desc')->paginate(50);
        return view()->first(["admin.{$this->name}.index", "admin::{$this->name}.index", 'admin::base.index'], ['models' => $models]);
    }
}
