<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryParameter;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $categoryCount = Category::count();

        return view("admin.categories.list", compact('categories', 'categoryCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.categories.create_form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create([
            'name' => request('name')
        ]);
        return redirect()->route('admin.category.index');
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
        $category = Category::find($id);
        return view("admin.categories.edit_form", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:20',
        ]);

        $category = Category::findOrFail($id);

        $category->update(array_merge($validatedData, [
            'featured' => $request->has('featured'),
        ]));

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.index');
    }
    
    public function listParameters(string $id) {
        $category = Category::with('category_parameters')->findOrFail($id);
        return view("admin.categories.list_parameters", compact('category'));
    }

    public function createParameters(string $id)
    {
        return view("admin.categories.create_parameter", compact('id'));
    }

    public function storeParameters(Request $request)
    {
        CategoryParameter::create([
            'description' => request('description'),
            'category_id' => request('category_id')
        ]);
        return redirect()->route('admin.category.parameters', request('category_id'));
    }

    public function disableParameters(string $id)
    {
        $categoryParameter = CategoryParameter::findOrFail($id);
        $categoryParameter->active = !$categoryParameter->active; // cambia el estado al contrario al actual
        $categoryParameter->save();
        return redirect()->route('admin.category.index');
    }
}
