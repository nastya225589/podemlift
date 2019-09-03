<?php

namespace Admin\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends BaseAdminController
{
    public function index()
    {
        $models = Log::orderBy('id', 'desc')->paginate(50);
        return view()->first(["admin.{$this->name}.index", "admin::{$this->name}.index", 'admin::base.index'], [
            'models' => $models
        ]);
    }
}
