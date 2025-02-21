<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input('category'); // recoje la posible categoria clickada por el usuario
        if ($category == null) {
            $products = Product::where('featured', true)->get(); // productos destacados
        }
        else {
            $products = Product::where('category_id', $category)->get(); // productos de una categoria
        }
        $categories = Category::all();
        return view("public.products.store_list", compact('products', 'categories'));
    }

    public function show(string $id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Category::all();
        return view("public.products.show", compact('product', 'categories'));
    }
}
