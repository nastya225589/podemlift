<?php

namespace Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Image;

class ImageController extends \Illuminate\Routing\Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request)
    {
        $alt = $request->file('image')->getClientOriginalName();
        $ext = $request->file('image')->getClientOriginalExtension();
        $alt = str_replace(".{$ext}", '', $alt);
        $data = Image::storeImage($request->file('image')->get(), $ext, $alt);
        return Response::json($data);
    }
}
