<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use App\Models\Usuario;
use App\Models\UsuarioEspecialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PerfilController extends Controller
{
    public function index()
    {
        $usuario_id = auth('usuarios')->user()->id;
        $usu = Usuario::find($usuario_id);
        $especialidades = $usu->especialidades->pluck('especialidad');
        $usuario = DB::select('CALL sp_perfil(?)', [$usuario_id])[0];
        return view('app.cliente.perfil.index', compact('usuario', 'especialidades'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $usuario = auth('usuarios')->user();
        return view("app.cliente.perfil.editar", compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        abort_unless($usuario->id === auth('usuarios')->id(), 403);

        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:11',
            'rol_id' => ['required', Rule::in([2, 3])],
        ]);

        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->telefono = $request->telefono;
        $usuario->rol_id = $request->rol_id;
        $usuario->pedido_1_clic = $request->has('pedido_1_clic');
        $usuario->update();

        return redirect()->route('cliente.perfil');
    }

    public function especialidades()
    {
        $especialidades = Especialidad::all();
        $usuario = auth('usuarios')->user();
        return view('app.cliente.perfil.especialidades', compact('especialidades', 'usuario'));
    }

    public function updateEspecialidades(Request $request)
    {
        $data = $request->validate([
            'especialidades' => 'sometimes|array',
            'especialidades.*' => 'integer|distinct|exists:especialidades,id',
        ]);
        $usuario_id = auth('usuarios')->user()->id;
        $especialidades_seleccionadas = $data['especialidades'] ?? [];

        // Obtener las especialidades actuales del dentista
        $especialidades_actuales = UsuarioEspecialidad::where('usuario_id', $usuario_id)
            ->pluck('especialidad_id')
            ->toArray();

        // Identificar las especialidades que se deben eliminar
        $especialidades_eliminar = is_array($especialidades_seleccionadas)
            ? array_diff($especialidades_actuales, $especialidades_seleccionadas)
            : $especialidades_actuales;

        // Identificar las especialidades que se deben agregar
        $especialidades_agregar = is_array($especialidades_seleccionadas)
            ? array_diff($especialidades_seleccionadas, $especialidades_actuales)
            : [];

        // Eliminar las especialidades que ya no están seleccionadas
        if (!empty($especialidades_eliminar)) {
            UsuarioEspecialidad::where('usuario_id', $usuario_id)
                ->whereIn('especialidad_id', $especialidades_eliminar)
                ->delete();
        }

        // Agregar las nuevas especialidades seleccionadas
        foreach ($especialidades_agregar as $especialidad_id) {
            UsuarioEspecialidad::create([
                'usuario_id' => $usuario_id,
                'especialidad_id' => $especialidad_id,
            ]);
        }

        return redirect()->route('cliente.perfil');
    }
}
