<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\PublicController;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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
    public function show(string $id) 
    {
        $order = Order::with('products')->find($id);

        $pdf = Pdf::loadView('public.orders.generatePDF', ['order' => $order]);
        
        return $pdf->download('factura.pdf');
    }
}
