<?php

namespace App\Http\Controllers;
use App\Models\Category;

class PublicController extends Controller
{
    public function __construct()
    {
        // Compartir las categorías en todas las vistas
        $categories = Category::all();
        view()->share('categories', $categories);
    }
}
