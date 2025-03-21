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
use Illuminate\Support\Facades\Http;

class OrderController extends PublicController
{
    function create()
    {
        return view("public.orders.checkout");
    }
    function book(Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }

            $cartData = $this->validateCart($request);
            if ($cartData instanceof JsonResponse) {
                return $cartData;
            }

            [$totalPrice, $cartItems] = $cartData;

            $order = $this->createOrder($user, $totalPrice, 'pending', $cartItems);

            return response()->json([
                'success' => true,
                'message' => 'Orden reservada correctamente',
                'order_id' => $order->id
            ], 201);
        } catch (\Exception $e) {
            Log::error("Error al reservar la orden: " . $e->getMessage());
            return response()->json(['error' => 'Error al procesar la reserva'], 500);
        }
    }
    function pay(Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }

            $cartData = $this->validateCart($request);
            if ($cartData instanceof JsonResponse) {
                return $cartData;
            }

            [$totalPrice, $cartItems] = $cartData;

            /*$existingOrder = Order::where('user_id', $user->id)
                ->where('status', 'pending')
                ->first();

            if ($existingOrder) {
                return response()->json([
                    'error' => 'Ya tienes una orden reservada. Debes pagarla antes de crear otra.'
                ], 400);
            }*/

            $order = $this->createOrder($user, $totalPrice, 'ordered', $cartItems);

            $redsysParams = [
                'amount' => $totalPrice,
                'order_id' => $order->id,
                'phone' => +34700000000
            ];

            $response = Http::post(route('redsys.pay'), $redsysParams);
        
            if ($response->failed()) {
                return response()->json(['error' => 'Error al procesar el pago'], 500);
            }
        
            return $response->json();
        } catch (\Exception $e) {
            Log::error("Error al procesar el pago: " . $e->getMessage());
            return response()->json(['error' => 'Error al procesar el pago' . $e->getMessage()], 500);
        }
    }
    public function show(string $id) 
    {
        $order = Order::with('products')->find($id);

        $pdf = Pdf::loadView('public.orders.generatePDF', ['order' => $order]);
        
        return $pdf->download('factura.pdf');
    }
    private function validateCart(Request $request)
    {
        $productLimit = Preference::where('key', 'ProductLimit')->value('value') ?? 3;

        $validated = $request->validate([
            'cart' => 'required|array',
            'cart.*.id' => 'required|exists:products,id',
            'cart.*.quantity' => 'required|integer|min:1|max:' . $productLimit,
        ]);

        $totalPrice = 0;
        $cartItems = [];

        foreach ($request->cart as $item) {
            $product = Product::find($item['id']);
            if (!$product) {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }
            $totalPrice += $product->price * $item['quantity'];
            $cartItems[] = $item;
        }

        return [$totalPrice, $cartItems];
    }
    private function createOrder($user, $totalPrice, $status, $cartItems)
    {
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_price = $totalPrice;
        $order->status = $status;
        $order->order_date = now();
        $order->save();

        foreach ($cartItems as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
            ]);
        }

        Log::info("Orden #{$order->id} ({$status}) creada por usuario {$user->id}, total: {$totalPrice}");

        return $order;
    }
}
