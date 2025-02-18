<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pendingOrders = Order::where('status', 'ordered')->whereDate('order_date', today()->toDateString())->get();
        $confirmedOrders = Order::where('status', 'confirmed')->whereDate('order_date', today()->toDateString())->get();
        $deniedOrders = Order::where('status', 'denied')->whereDate('order_date', today()->toDateString())->get();
        $allOrders = Order::get();
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role == "admin") {
                return view("orders.list", compact('pendingOrders', 'confirmedOrders', 'deniedOrders', 'allOrders'));
            }
            else {
                return redirect()->route('dashboard');
            }
        } 
        else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
