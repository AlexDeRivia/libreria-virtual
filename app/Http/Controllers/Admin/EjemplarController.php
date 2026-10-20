<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ejemplar;
use App\Models\Libro;
use App\Models\Idioma;
use Illuminate\Http\Request;

class EjemplarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ejemplares = Ejemplar::with('libro', 'idioma')->get();
        return view('app.admin.ejemplares.index', compact('ejemplares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $libros = Libro::all();
        $idiomas = Idioma::all();
        return view('app.admin.ejemplares.create',  compact('libros', 'idiomas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'numero_ejemplar'=> "required|unique:ejemplares,numero_ejemplar",
            'precio' => "required|numeric|min:0",
            'stock' => "required|integer|min:0",
            'libro_id' => "required|integer|exists:libros,id",
            'idioma_id' => "required|integer|exists:idiomas,id",
        ]);
        Ejemplar::create($data);
        return redirect()->route('admin.ejemplares');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ejemplar $ejemplar)
    {
        return view('app.admin.ejemplares.show', compact('ejemplar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ejemplar $ejemplar)
    {
        $libros = Libro::all();
        $idiomas = Idioma::all();
        return view('app.admin.ejemplares.edit', compact('ejemplar', 'libros', 'idiomas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ejemplar $ejemplar)
    {
        $data = $request->validate([
            'numero_ejemplar'=> "required|unique:ejemplares,numero_ejemplar,$ejemplar->id,id",
            'precio' => "required|numeric|min:0",
            'stock' => "required|integer|min:0",
            'libro_id' => "required|integer|exists:libros,id",
            'idioma_id' => "required|integer|exists:idiomas,id",
        ]);
        $ejemplar->update($data);
        return redirect()->route('admin.ejemplares');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ejemplar $ejemplar)
    {
        if ($ejemplar->lineaPedidos()->exists()) {
            return back()->withErrors(['ejemplar' => 'No se puede eliminar un ejemplar incluido en pedidos.']);
        }
        $ejemplar->delete();
        return redirect()->route('admin.ejemplares');
    }
}
