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
        $redirects = json_decode($request->redirects, true);
        $model = new $this->model;
        $request->validate($model->validatorRules($request));
        $model = $model->create($request->all());
        $model->setRedirects($redirects);
        $model->properties()->sync($request->property_ids);
        return redirect($this->redirectTo);
    }

    public function update(Request $request, $id)
    {
        $redirects = json_decode($request->redirects, true);
        $model = $this->model::findOrFail($id);
        $request->validate($model->validatorRules($request));
        $model = $model->fill($request->all());
        $model->setRedirects($redirects);
        $model->save();
        $model->properties()->sync($request->property_ids);
        return redirect($this->redirectTo);
    }
}
