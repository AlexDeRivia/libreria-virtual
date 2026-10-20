<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nacionalidad;
use Illuminate\Http\Request;

class NacionalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nacionalidades = Nacionalidad::all();
        return view('app.admin.nacionalidades.index', compact('nacionalidades'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.admin.nacionalidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nacionalidad'=> "required|unique:nacionalidades,nacionalidad",
        ]);
        Nacionalidad::create($request->all());
        return redirect()->route('admin.nacionalidades');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nacionalidad $nacionalidad)
    {
        return view('app.admin.nacionalidades.show', compact('nacionalidad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nacionalidad $nacionalidad)
    {
        return view('app.admin.nacionalidades.edit', compact('nacionalidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nacionalidad $nacionalidad)
    {
        $request->validate([
            'nacionalidad'=> "required|unique:nacionalidades,nacionalidad,$nacionalidad->id,id"
        ]);
        $nacionalidad->update($request->all());
        return redirect()->route('admin.nacionalidades');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nacionalidad $nacionalidad)
    {
        $nacionalidad->delete();
        return redirect()->route('admin.nacionalidades');
    }
}
