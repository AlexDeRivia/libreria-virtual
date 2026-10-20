<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use App\Models\Nacionalidad;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $autores = Autor::with('nacionalidad')->get();
        return view('app.admin.autores.index', compact('autores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nacionalidades = Nacionalidad::all();
        return view('app.admin.autores.create',  compact('nacionalidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres'=> "required",
            'apellidos'=> "required"
        ]);
        Autor::create($request->all());
        return redirect()->route('admin.autores');
    }

    /**
     * Display the specified resource.
     */
    public function show(Autor $autor)
    {
        return view('app.admin.autores.show', compact('autor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Autor $autor)
    {
        $nacionalidades = Nacionalidad::all();
        return view('app.admin.autores.edit', compact('autor', 'nacionalidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Autor $autor)
    {
        $request->validate([
            'nombres'=> "required|unique:autores,nombres,$autor->id,id",
            'apellidos'=> "required|unique:autores,apellidos,$autor->id,id"
        ]);
        $autor->update($request->all());
        return redirect()->route('admin.autores');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Autor $autor)
    {
        $autor->delete();
        return redirect()->route('admin.autores');
    }
}
