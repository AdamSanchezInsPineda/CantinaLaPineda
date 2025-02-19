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

                $imagePaths = [];

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('products', 'public');
                        $imagePaths[] = $path;
                    }
                }

                Product::create(array_merge($validatedData, [
                    'featured' => $request->has('featured'),
                    'images' => json_encode($imagePaths)
                ]));

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
    
        // Laravel ya maneja los atributos JSON automáticamente
        $existingImages = $product->images ?? [];
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $existingImages[] = $path;
            }
        }
    
        // Guardamos sin json_encode()
        $product->update(array_merge($validatedData, [
            'featured' => $request->has('featured'),
            'images' => $existingImages, // Laravel lo convertirá a JSON automáticamente
        ]));
    
        return redirect()->route('product.index')->with('status', 'Producto actualizado correctamente');
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
