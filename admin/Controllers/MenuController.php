<?php

namespace Admin\Controllers;

class MenuController extends BaseAdminController
{
    public function index()
    {
        return view()->first(["admin.{$this->name}.index", "admin::{$this->name}.index", 'admin::base.index'], [
            'name' => $this->name,
            'action' => $this->action,
            'models' => $this->model::where(['parent_id' => null])->orderBy('sort')->paginate(50)
        ]);
    }
}
