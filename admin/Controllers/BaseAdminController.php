<?php

namespace Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BaseAdminController extends \Illuminate\Routing\Controller
{
    public $name;
    public $action;
    public $route;
    public $model;
    protected $redirectTo;

    public function __construct()
    {
        $this->middleware('auth');

        if (!$this->name && !app()->runningInConsole()) {
            $action = app('request')->route()->getAction();
            $controller = class_basename($action['controller']);
            [$controller, $this->action] = explode('@', $controller);
            $this->name = Str::snake(str_replace('Controller', '', $controller));
        }

        if (!$this->model) {
            $class = Str::studly($this->name);
            $this->model = "\App\Models\\$class";
        }

        $this->route = Str::slug($this->name);

        if (!$this->redirectTo && !app()->runningInConsole()) {
            $this->redirectTo = route("{$this->route}.index");
        }
    }

    public function index()
    {
        return view()->first(["admin.{$this->name}.index", "admin::{$this->name}.index", 'admin::base.index'], [
            'name' => $this->name,
            'route' => $this->route,
            'action' => $this->action,
            'models' => $this->model::orderBy('id')->paginate(100)
        ]);
    }

    public function create()
    {
        return view()->first(["admin.{$this->name}.create", "admin::{$this->name}.create", 'admin::base.create'], [
            'name' => $this->name,
            'route' => $this->route,
            'action' => $this->action,
            'model' => new $this->model
        ]);
    }

    public function store(Request $request)
    {
        if ($request->redirects) {
            $redirects = json_decode($request->redirects, true);
        }

        $model = new $this->model;
        $request->validate($model->validatorRules($request));
        $model = $model->create($request->all());

        if (isset($redirects)) {
            $model->setRedirects($redirects);
        }

        return redirect($this->redirectTo);
    }

    public function show($id = null)
    {
        return view()->first(["admin.{$this->name}.show", "admin::{$this->name}.show", 'admin::base.show'], [
            'name' => $this->name,
            'route' => $this->route,
            'action' => $this->action,
            'model' => $this->model::findOrFail($id)
        ]);
    }

    public function edit($id = null)
    {
        return view()->first(["admin.{$this->name}.edit", "admin::{$this->name}.edit", 'admin::base.edit'], [
            'name' => $this->name,
            'route' => $this->route,
            'action' => $this->action,
            'model' => $this->model::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->redirects) {
            $redirects = json_decode($request->redirects, true);
        }

        $model = new $this->model;
        $request->validate($model->validatorRules($request));
        $model = $model->findOrFail($id);
        if (isset($redirects)) {
            $model->setRedirects($redirects);
        }

        $model->fill($request->all())->save();
        return redirect($this->redirectTo);
    }

    public function destroy($id)
    {
        $this->model::findOrFail($id)->delete();
        return redirect($this->redirectTo);
    }

    public function copy($id)
    {
        $from = $this->model::findOrFail($id);
        $to = $from->replicate();
        $to->name .= ' - copy';
        $to->save();
        return redirect($this->redirectTo);
    }

    public function child($id)
    {
        $from = $this->model::findOrFail($id);
        $to = new $this->model([
            'name' => "Child",
            'parent_id' => $from->id,
            'published' => 0,
            'slug' => 'child'
        ]);
        $to->save();
        return redirect($this->redirectTo);
    }
}
