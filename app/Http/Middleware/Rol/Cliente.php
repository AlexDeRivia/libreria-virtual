<?php

namespace App\Http\Middleware\Rol;

use App\Services\CartExpirationService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cliente
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

        app(CartExpirationService::class)->releaseExpired();

        return $next($request);
    }

    private function validar()
    {
        $user = auth('usuarios')->user();

        if (isset($user)) {
            $rol_id = $user->rol_id;
            switch ($rol_id) {
                case 1:
                    return 'admin.home';
                    break;
                case 2:
                    break;
                case 3:
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
