<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\PublicController;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends PublicController
{
    public function index(Request $request)
    {
        $products = Product::where('featured', true)->get();
        return view("public.products.list", compact('products'));
    }

    public function show(string $id)
    {
        $product = Product::where('id', $id)->first();
        return view("public.products.show", compact('product'));
    }
    public function getProductsVersion()
    {
        $lastUpdated = Product::orderBy('updated_at', 'desc')->value('updated_at');
        return response()->json(['last_updated_at' => $lastUpdated]);
    }
    public function getProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }
}
