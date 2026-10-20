<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paises = Pais::all();
        return view('app.admin.paises.index', compact('paises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.admin.paises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=> "required|unique:paises,nombre",
        ]);
        Pais::create($request->all());
        return redirect()->route('admin.paises');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pais $pais)
    {
        return view('app.admin.paises.show', compact('pais'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pais $pais)
    {
        return view('app.admin.paises.edit', compact('pais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pais $pais)
    {
        $request->validate([
            'nombre'=> "required|unique:paises,nombre,$pais->id,id"
        ]);
        $pais->update($request->all());
        return redirect()->route('admin.paises');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pais $pais)
    {
        $pais->delete();
        return redirect()->route('admin.paises');
    }
}
