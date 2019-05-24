<?php

namespace Admin\Controllers;

class ServiceCategoryController extends BaseAdminController
{
    public function index()
    {
        return view()->first(["admin.{$this->name}.index", "admin::{$this->name}.index", 'admin::base.index'], [
            'name' => $this->name,
            'route' => $this->route,
            'action' => $this->action,
            'models' => $this->model::where(['parent_id' => null])->orderBy('sort')->get()
        ]);
    }
}
