<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Idioma;
use App\Models\Especialidad;
use App\Models\Autor;
use App\Models\Ejemplar;
use App\Models\Nacionalidad;
use App\Models\PreferenciaEnvio;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $usuarios = Usuario::whereIn('rol_id', [2, 3, 4])->count();
        $paises = Pais::count();
        $provincias = Provincia::count();
        $idiomas = Idioma::count();
        $especialidades = Especialidad::count();
        $autores = Autor::count();
        $ejemplares = Ejemplar::count();
        $nacionalidades = Nacionalidad::count();
        $preferenciasEnvio = PreferenciaEnvio::count();

        return view('app.admin.home', compact(
            'usuarios',
            'paises',
            'provincias',
            'idiomas',
            'especialidades',
            'autores',
            'ejemplares',
            'nacionalidades',
            'preferenciasEnvio'
        ));
    }
    public function perfil()
    {
        $usuario = auth('usuarios')->user();
        $usuario->load('pais');
        $usuario->load('provincia');
        return view('app.admin.perfil', compact('usuario'));
    }
}
