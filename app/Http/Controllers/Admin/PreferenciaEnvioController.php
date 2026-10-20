<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PreferenciaEnvio;
use Illuminate\Http\Request;

class PreferenciaEnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $preferencia_envios = PreferenciaEnvio::all();
        return view('app.admin.preferenciasEnvio.index', compact('preferencia_envios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.admin.preferenciasEnvio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'preferencia'=> "required|unique:preferencia_envios,preferencia",
        ]);
        PreferenciaEnvio::create($request->all());
        return redirect()->route('admin.preferenciasEnvio');
    }

    /**
     * Display the specified resource.
     */
    public function show(PreferenciaEnvio $preferencia_envio)
    {
        return view('app.admin.preferenciasEnvio.show', compact('preferencia_envio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PreferenciaEnvio $preferencia_envio)
    {
        return view('app.admin.preferenciasEnvio.edit', compact('preferencia_envio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PreferenciaEnvio $preferencia_envio)
    {
        $request->validate([
            'preferencia'=> "required|unique:preferencia_envios,preferencia,$preferencia_envio->id,id"
        ]);
        $preferencia_envio->update($request->all());
        return redirect()->route('admin.preferenciasEnvio');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PreferenciaEnvio $preferencia_envio)
    {
        $preferencia_envio->delete();
        return redirect()->route('admin.preferenciasEnvio');
    }
}
