<?php

namespace App\Http\Middleware\Rol;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ruta = $this->validar();

        if ($ruta !== null) {
            return redirect()->route($ruta);
        }

        return $next($request);
    }

    private function validar()
    {
        $user = auth('usuarios')->user();

        if (isset($user)) {
            $rol_id = $user->rol_id;
            switch ($rol_id) {
                case 1:
                    break;
                case 2:
                    return 'cliente.home';
                    break;
                case 3:
                    return 'cliente.home';
                    break;
                case 4:
                    return 'encargado.home';
                    break;
                default:
                    abort(403);
            }
        } else {
            return 'login';
        }
        return null;
    }
}
