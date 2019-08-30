<?php

namespace Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserController extends BaseAdminController
{
    use RegistersUsers;

    public function edit($id = null)
    {
        $model = $this->model::findOrFail($id);
        $model->password = '';
        return view()->first(["admin.{$this->name}.edit", "admin::{$this->name}.edit", 'admin::base.edit'], [
            'name' => $this->name,
            'action' => $this->action,
            'route' => $this->route,
            'model' => $model
        ]);
    }

    public function store(Request $request)
    {
        $model = new $this->model;
        $request->validate($model->validatorRules($request));
        $post = $request->all();
        $post['password'] = Hash::make($post['password']);
        $model->create($post);
        return redirect($this->redirectTo);
    }

    public function update(Request $request, $id)
    {
        $model = new $this->model;
        $request->validate($model->validatorRules($request));
        $post = $request->all();
        $post['password'] = Hash::make($post['password']);
        $model->findOrFail($id)->fill($post)->save();
        return redirect($this->redirectTo);
    }
}
