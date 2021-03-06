<?php

namespace Admin\Controllers;

use Illuminate\Http\Request;

class ApplicationSphereController extends BaseAdminController
{
    public function edit($id = null)
    {
        $model = $this->model::findOrFail($id);
        $model->category_ids = $model->categories->pluck('id')->toArray();

        return view()->first(["admin.{$this->name}.edit", "admin::{$this->name}.edit", 'admin::base.edit'], [
            'name' => $this->name,
            'route' => $this->route,
            'action' => $this->action,
            'model' => $model
        ]);
    }

    public function store(Request $request)
    {
        $model = new $this->model;
        $request->validate($model->validatorRules($request));
        $model = $model->create($request->all());
        $model->categories()->sync($request->category_ids);
        $model->properties()->sync($request->property_ids);
        return redirect($this->redirectTo);
    }

    public function update(Request $request, $id)
    {
        $model = $this->model::findOrFail($id);
        $request->validate($model->validatorRules($request));
        $model = $model->fill($request->all());
        $model->save();
        $model->categories()->sync($request->category_ids);
        $model->properties()->sync($request->property_ids);
        return redirect($this->redirectTo);
    }
}
