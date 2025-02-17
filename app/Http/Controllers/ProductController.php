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
        $product = Product::find($id);
        $categories = Category::all();
        return view("products.edit_form", compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'code'         => 'required|string|max:50|unique:products,code,' . $id,
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string|max:500',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'featured'     => 'boolean',
            'images'       => 'nullable|array',
            'images.*'     => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $product->update(array_merge($validatedData, [
            'featured' => $request->has('featured'),
        ]));

        return redirect()->route('product.index');
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
