<?php

namespace App\Http\Controllers\Admin;

use App\Models\Preference;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $preferences = Preference::all();

        return view("admin.preferences.list", compact('preferences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $preference = Preference::find($id);
        return view("admin.preferences.edit_form", compact('preference'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'value' => 'required|string|max:20',
        ]);

        $preference = Preference::findOrFail($id);

        $preference->update(array_merge($validatedData, [
        ]));

        return redirect()->route('admin.preference.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
