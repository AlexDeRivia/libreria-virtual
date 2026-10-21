<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function mostrarFormulario()
    {
        if (config('demo.public_access')) {
            return redirect(route('home').'#explorar-demo');
        }

        $paises = Pais::all();
        return view('app.register', compact('paises'));
    }

    public function cargarProvincias(Request $request)
    {
        $paisId = $request->pais_id;
        $provincias = Provincia::where('pais_id', $paisId)->get();
        return response()->json($provincias);
    }

    public function cargarEspecialidades()
    {
        $especialidades = Especialidad::all();
        return response()->json($especialidades);
    }

    public function store(Request $request)
    {
        abort_if(config('demo.public_access'), 403);

        $data = $request->validate([
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:8',
            'password_2' => 'required|same:password',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:11',
            'rol_id' => ['required', Rule::in([2, 3])],
            'pais_id' => 'required|exists:paises,id',
            'provincia_id' => ['required', Rule::exists('provincias', 'id')->where('pais_id', $request->input('pais_id'))],
            'localidad' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:20',
            'especialidades' => 'required_if:rol_id,3|array|min:1',
            'especialidades.*' => 'integer|distinct|exists:especialidades,id',
        ], [
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password_2.same' => 'Las contraseñas no coinciden.',
        ]);

        DB::transaction(function () use ($request, $data) {
            $usuario = new Usuario();
            $usuario->email = $data['email'];
            $usuario->password = bcrypt($data['password']);
            $usuario->apellidos = $data['apellidos'];
            $usuario->nombres = $data['nombres'];
            $usuario->telefono = $data['telefono'];
            $usuario->pedido_1_clic = $request->has('pedido_1_clic');
            $usuario->rol_id = $data['rol_id'];
            $usuario->pais_id = $data['pais_id'];
            $usuario->provincia_id = $data['provincia_id'];
            $usuario->localidad = $data['localidad'];
            $usuario->direccion = $data['direccion'];
            $usuario->codigo_postal = $data['codigo_postal'];
            $usuario->save();

            if (isset($data['especialidades'])) {
                $usuario->especialidades()->attach($data['especialidades']);
            }
        });

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        auth('usuarios')->attempt($credentials, true);
        $request->session()->regenerate();
        return redirect()->route('cliente.home');
    }
}
