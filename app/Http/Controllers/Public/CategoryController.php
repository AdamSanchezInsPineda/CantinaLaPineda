<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\PublicController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends PublicController
{
    public function show($category_name)
    {
        $category = Category::where('slug', $category_name)->firstOrFail();

        $products = $category->products;

        return view("public.products.list", compact('products'));
    }
}
