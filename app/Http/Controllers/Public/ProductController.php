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
        $product = Product::find($id);

        $images = $product->images ?? [];

        $frontImage = isset($images[0]) ? $images[0] : null;

        $otherImages = array_slice($images, 1);

        return view("public.products.show", compact('product', 'frontImage', 'otherImages'));
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
