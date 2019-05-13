<?php

namespace Admin\Controllers;

use Illuminate\Http\Request;

class NestableController extends \Illuminate\Routing\Controller
{

    private $class;
    private $request;

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
        $this->class = $this->ns($request->resource);
    }

    public function save()
    {
        foreach($this->request->data as $index => $item)
            $this->store($item, $index);
    }

    private function store($item, $index, $parent = null)
    {
        $this->class::find($item['id'])->fill(['sort' => $index, 'parent_id' => $parent])->save();
        if (!empty($item['children']))
            foreach ($item['children'] as $index => $child)
                $this->store($child, $index, $item['id']);
    }

    private function ns($resource)
    {
        $model = studly_case($resource);
        if (file_exists(app_path("Models/{$model}.php")))
            return '\App\Models\\' . $model;

        return '\Admin\Models\\' . $model;
    }
}
