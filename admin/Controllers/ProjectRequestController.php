<?php

namespace Admin\Controllers;

use App\Models\ProjectRequest;

class ProjectRequestController extends BaseAdminController
{
    public function index()
    {
        $models = ProjectRequest::orderBy('id', 'desc')->paginate(50);
        return view()->first(["admin.{$this->name}.index", "admin::{$this->name}.index", 'admin::base.index'], ['models' => $models]);
    }
}
