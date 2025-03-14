<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\PublicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends PublicController
{
    function create()
    {
        return view("public.orders.checkout");
    }

    function store(Request $request)
    {
        Log::info($request->all());

        return response()->json(['message' => 'Compra realizada']);
    }
}
