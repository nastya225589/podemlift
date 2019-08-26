<?php

namespace Admin\Controllers;

use Illuminate\Http\Request;

class ProductCategoryController extends BaseAdminController
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
    
    public function edit($id = null)
    {
        $model = $this->model::findOrFail($id);
        $model->property_ids = $model->properties->pluck('id')->toArray();

        return view()->first(["admin.{$this->name}.edit", "admin::{$this->name}.edit", 'admin::base.edit'], [
            'name' => $this->name,
            'route' => $this->route,
            'action' => $this->action,
            'model' => $model
        ]);
    }

    public function store(Request $request)
    {
        $model = $this->model::create($request->all());
        $model->properties()->sync($request->property_ids);
        return redirect($this->redirectTo);
    }

    public function update(Request $request, $id)
    {
        $model = $this->model::findOrFail($id)->fill($request->all());
        $model->save();
        $model->properties()->sync($request->property_ids);
        return redirect($this->redirectTo);
    }
}
