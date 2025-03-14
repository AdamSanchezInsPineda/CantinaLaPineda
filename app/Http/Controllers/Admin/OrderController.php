<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingOrders = Order::where('status', 'ordered')->whereDate('order_date', today()->toDateString())->get();
        $confirmedOrders = Order::where('status', 'confirmed')->whereDate('order_date', today()->toDateString())->get();
        $deniedOrders = Order::where('status', 'denied')->whereDate('order_date', today()->toDateString())->get();
        $allOrders = Order::get();

        return view("admin.orders.list", compact('pendingOrders', 'confirmedOrders', 'deniedOrders', 'allOrders'));
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
        $order = Order::with('products')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
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

    public function getMonthlySales()
    {
        $monthlySales = array_fill(0, 12, 0);
        
        $sales = OrderProduct::selectRaw('EXTRACT(MONTH FROM created_at) as month, SUM(quantity) as total_sales')
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
        ->get();    

        foreach ($sales as $sale) {
            $monthlySales[$sale->month - 1] = $sale->total_sales;
        }

        $salesData = [
            'sales' => array_map(function($month, $sales) {
                return [
                    'month' => $month + 1,
                    'sales' => $sales,
                ];
            }, array_keys($monthlySales), $monthlySales)
        ];

        dd($salesData);

        return response()->json($salesData);
    }
}
