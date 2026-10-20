<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pais;
use App\Models\Provincia;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provincias = Provincia::with('pais')->get();
        return view('app.admin.provincias.index', compact('provincias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paises = Pais::all();
        return view('app.admin.provincias.create',  compact('paises'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=> "required|unique:provincias,nombre",
        ]);
        Provincia::create($request->all());
        return redirect()->route('admin.provincias');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provincia $provincia)
    {
        return view('app.admin.provincias.show', compact('provincia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provincia $provincia)
    {
        $paises = Pais::all();
        return view('app.admin.provincias.edit', compact('provincia', 'paises'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provincia $provincia)
    {
        $request->validate([
            'nombre'=> "required|unique:provincias,nombre,$provincia->id,id",
        ]);
        $provincia->update($request->all());
        return redirect()->route('admin.provincias');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provincia $provincia)
    {
        $provincia->delete();
        return redirect()->route('admin.provincias');
    }
}
