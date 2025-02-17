<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role == "admin") {
                return view("products.list", compact('products'));
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
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role == "admin") {
                $categories = Category::all();
                return view("products.create_form", compact('categories'));
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role == "admin") {
                Product::create([
                    'name' => request('name'),
                    'description' => request('description'),
                    'stock' => request('stock'),
                    'price' => request('price'),
                    'featured' => request('featured'),
                    'code' => request('code'),
                    'category_id' => request('category_id')
                ]);
                return redirect()->route('product.index');
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
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role == "admin") {
                $product = Product::findOrFail($id);
                $product->delete();
                return redirect()->route('product.index');
            }
            else {
                return redirect()->route('dashboard');
            }
        } 
        else {
            return redirect()->route('login');
        }
    }
}
