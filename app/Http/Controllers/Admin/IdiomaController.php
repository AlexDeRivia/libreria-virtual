<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idiomas = Idioma::all();
        return view('app.admin.idiomas.index', compact('idiomas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.admin.idiomas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idioma'=> "required|unique:idiomas,idioma",
        ]);
        Idioma::create($request->all());
        return redirect()->route('admin.idiomas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idioma $idioma)
    {
        return view('app.admin.idiomas.show', compact('idioma'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idioma $idioma)
    {
        return view('app.admin.idiomas.edit', compact('idioma'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Idioma $idioma)
    {
        $request->validate([
            'idioma'=> "required|unique:idiomas,idioma,$idioma->id,id"
        ]);
        $idioma->update($request->all());
        return redirect()->route('admin.idiomas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idioma $idioma)
    {
        $idioma->delete();
        return redirect()->route('admin.idiomas');
    }
}
