<?php

namespace Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends \Illuminate\Routing\Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request)
    {
        $path = Storage::disk('local')->put('public/files', $request->file('file'));
        return response()->json([
            'status' => 200,
            'path' => $path
        ]);
    }

    public function download(Request $request)
    {
        return Storage::disk('local')->download($request->path);
    }
}
