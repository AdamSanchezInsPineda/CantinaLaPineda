<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\PublicController;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryParameter;
use Illuminate\Http\Request;

class ProductController extends PublicController
{
    public function index(Request $request)
    {
        $products = Product::where('featured', true)->where('active', true)->get();
        return view("public.products.list", compact('products'));
    }

    public function show(string $id)
    {
        $product = Product::find($id);

        if (!$product || !$product->active) {
            abort(404);
        }

        $category = Category::findOrFail($product->category_id);
        $categoryParameters = CategoryParameter::where('category_id', $category->id)->get();

        $images = $product->images ?? [];

        $frontImage = isset($images[0]) ? $images[0] : null;

        $otherImages = array_slice($images, 1);

        return view("public.products.show", compact('product', 'frontImage', 'otherImages', 'categoryParameters'));
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
