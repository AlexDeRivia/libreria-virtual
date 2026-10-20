<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function mostrarFormulario()
    {
        /*
        $usuario_id = 2;
        $resultados = DB::select('CALL SeleccionarEjemplaresPorEspecialidad(?)', array($usuario_id));
        return $resultados;

        $resultados = DB::table('TodosLosEjemplares')->get();
        return $resultados;
        */

        return view('app.login');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = $request->has('remember');

        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        if (auth('usuarios')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $rol_id = auth('usuarios')->user()->rol_id;

            switch ($rol_id) {
                case 1:
                    return redirect()->route('admin.home');
                    break;
                case 2:
                    return redirect()->route('cliente.home');
                    break;
                case 3:
                    return redirect()->route('cliente.home');
                    break;
                case 4:
                    return redirect()->route('encargado.home');
                    break;
                default:
                    abort(403);
            }
        } else {
            return back()->withErrors(['correo' => 'Credenciales incorrectas'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        auth('usuarios')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
