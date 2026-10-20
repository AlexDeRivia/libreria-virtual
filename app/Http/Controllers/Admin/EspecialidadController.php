<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $especialidades = Especialidad::all();
        return view('app.admin.especialidades.index', compact('especialidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.admin.especialidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'especialidad'=> "required|unique:especialidades,especialidad",
        ]);
        Especialidad::create($request->all());
        return redirect()->route('admin.especialidades');
    }

    /**
     * Display the specified resource.
     */
    public function show(Especialidad $especialidad)
    {
        return view('app.admin.especialidades.show', compact('especialidad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Especialidad $especialidad)
    {
        return view('app.admin.especialidades.edit', compact('especialidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Especialidad $especialidad)
    {
        $request->validate([
            'especialidad'=> "required|unique:especialidades,especialidad,$especialidad->id,id"
        ]);
        $especialidad->update($request->all());
        return redirect()->route('admin.especialidades');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Especialidad $especialidad)
    {
        $especialidad->delete();
        return redirect()->route('admin.especialidades');
    }
}

