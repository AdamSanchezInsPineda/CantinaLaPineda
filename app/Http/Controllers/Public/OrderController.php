<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\PublicController;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use App\Models\Preference;
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
        try {
            $productLimit = Preference::where('key', 'ProductLimit')->value('value') ?? 3;

            $request->validate([
                'cart' => 'required|array',
                'cart.*.id' => 'required|exists:products,id',
                'cart.*.quantity' => 'required|integer|min:1|max:' . $productLimit,
            ]);            
    
            $user = auth()->user();
            if (!$user) {
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }
    
            $totalPrice = 0;
    
            foreach ($request->cart as $item) {
                $product = Product::find($item['id']);
                
                if (!$product) {
                    return response()->json(['error' => 'Producto no encontrado'], 404);
                }
                
                /*if ($product->stock < $item['quantity']) {
                    return response()->json([
                        'error' => "Stock insuficiente para {$product->name}. Stock disponible: {$product->stock}"
                    ], 400);
                }*/
                
                $totalPrice += $product->price * $item['quantity'];
            }
    
            $order = new Order();
            $order->user_id = $user->id;
            $order->total_price = $totalPrice;
            $order->status = 'pending';
            $order->order_date = now();
            $order->save();
    
            foreach ($request->cart as $item) {
                $product = Product::find($item['id']);
                
                $orderProduct = new OrderProduct();
                $orderProduct->product_id = $item['id'];
                $orderProduct->order_id = $order->id;
                $orderProduct->quantity = $item['quantity'];
                $orderProduct->save();
                
                // $product->stock -= $item['quantity'];
                $product->save();
            }
    
            Log::info("Orden #{$order->id} creada por el usuario {$user->id} por un total de {$totalPrice}");
    
            return response()->json([
                'success' => true,
                'message' => 'Orden creada correctamente',
                'order_id' => $order->id
            ], 201);
        } catch (\Exception $e) {
            Log::error("Error al crear la orden: " . $e->getMessage());
            return response()->json(['error' => 'Error al procesar la orden'. $e->getMessage()], 500);
        }
    }
    public function show(string $id) 
    {
        $order = Order::with('products')->find($id);

        $pdf = Pdf::loadView('public.orders.generatePDF', ['order' => $order]);
        
        return $pdf->download('factura.pdf');
    }
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        return view('public.orders.options', compact('order'));
    }
    public function update(Request $request) {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);
    
        $order = Order::findOrFail($request->order_id);

        if ($order->status === 'reserved') {
            return redirect()->back()->with('warning', 'Esta orden ya está reservada.');
        }

        $order->update(['status' => 'reserved']);
    
        return view('public.orders.success');
    }
}