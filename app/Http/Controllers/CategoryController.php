<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role == "admin") {
                return view("categories.list", compact('categories'));
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
                return view("categories/create_form");
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
                Category::create([
                    'name' => request('name')
                ]);
                return redirect()->route('category.index');
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
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role == "admin") {
                $category = Category::find($id);
                return view("categories.edit_form", compact('category'));
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'name'         => 'required|string|max:20',
        ]);

        $category = Category::findOrFail($id);

        $category->update(array_merge($validatedData, [
            'featured' => $request->has('featured'),
        ]));

        return redirect()->route('category.index');
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
                $category = Category::findOrFail($id);
                $category->delete();
                return redirect()->route('category.index');
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
