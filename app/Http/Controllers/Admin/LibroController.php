<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use App\Models\Especialidad;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libros = Libro::all();
        return view('app.admin.libros.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $autores = Autor::all('id', 'nombres', 'apellidos');
        $especialidades = Especialidad::all('id', 'especialidad');
        return view('app.admin.libros.create', compact('autores', 'especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateLibro($request);

        DB::transaction(function () use ($request, $data) {
            $libro = Libro::create([
                'isbn' => $data['isbn'],
                'titulo' => $data['titulo'],
                'resumen' => $data['resumen'],
                'es_novedad' => $request->boolean('es_novedad'),
            ]);
            $this->syncRelations($libro, $data);
        });

        return redirect()->route('admin.libros');
    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {
        $libro->load('autores', 'especialidades', 'ejemplares');
        return view('app.admin.libros.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Libro $libro)
    {
        $libro->load('autores', 'especialidades');
        $autores = Autor::all('id', 'nombres', 'apellidos');
        $especialidades = Especialidad::all('id', 'especialidad');
        return view('app.admin.libros.edit', compact('autores', 'especialidades', 'libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        $data = $this->validateLibro($request, $libro);

        DB::transaction(function () use ($request, $libro, $data) {
            $libro->update([
                'isbn' => $data['isbn'],
                'titulo' => $data['titulo'],
                'resumen' => $data['resumen'],
                'es_novedad' => $request->boolean('es_novedad'),
            ]);
            $this->syncRelations($libro, $data);
        });

        return redirect()->route('admin.libros');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        if ($libro->ejemplares()->exists()) {
            return back()->withErrors(['libro' => 'Elimina primero los ejemplares de este libro.']);
        }

        DB::transaction(function () use ($libro) {
            $libro->autores()->detach();
            $libro->especialidades()->detach();
            $libro->delete();
        });

        return redirect()->route('admin.libros');
    }

    private function validateLibro(Request $request, ?Libro $libro = null): array
    {
        return $request->validate([
            'isbn' => ['required', 'string', 'max:20', Rule::unique('libros', 'isbn')->ignore($libro?->id)],
            'titulo' => 'required|string|max:255',
            'resumen' => 'required|string',
            'autor_id' => 'required|array|min:1',
            'autor_id.*' => 'integer|distinct|exists:autores,id',
            'es_principal' => 'sometimes|array',
            'es_principal.*' => 'integer|exists:autores,id',
            'especialidad_id' => 'required|array|min:1',
            'especialidad_id.*' => 'integer|distinct|exists:especialidades,id',
        ]);
    }

    private function syncRelations(Libro $libro, array $data): void
    {
        $principales = array_map('intval', $data['es_principal'] ?? []);
        $autores = [];
        foreach ($data['autor_id'] as $id) {
            $autores[$id] = ['es_principal' => in_array((int) $id, $principales, true)];
        }
        $libro->autores()->sync($autores);
        $libro->especialidades()->sync($data['especialidad_id']);
    }
}
