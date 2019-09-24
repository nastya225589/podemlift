<?php

namespace App\Http\Controllers;

use App\Models\BackCall;
use Illuminate\Http\Request;

class BackCallController extends Controller
{
    public function store(Request $request)
    {
        $backCall = new BackCall;
        $request->validate($backCall->validatorRules($request));
        $backCall->create($request->all());
        return response()->json([
            'message' => "Спасибо, ваша заявка отправлена! Мы перезвоним вам в течение 15 минут.",
            'status' => 200
        ]);
    }
}
