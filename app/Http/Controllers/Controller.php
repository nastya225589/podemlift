<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Services\Contracts\FilterServiceInterface;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $resource;
    protected $filterService;

    public function __construct(Request $request, FilterServiceInterface $filterService)
    {
        $action = $request->route()->getAction();
        $this->resource = isset($action['resource']) ? $action['resource'] : '';
        $this->filterService = $filterService;
    }

}
