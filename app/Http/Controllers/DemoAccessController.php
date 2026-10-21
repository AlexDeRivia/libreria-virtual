<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class DemoAccessController extends Controller
{
    public function enter(Request $request, string $role)
    {
        abort_unless(config('demo.public_access'), 404);

        $profile = config("demo.roles.{$role}");
        abort_unless(is_array($profile), 404);

        $user = Usuario::query()
            ->where('email', $profile['email'])
            ->where('rol_id', $profile['role_id'])
            ->first();
        abort_unless($user, 503, 'Esta cuenta de demostración no está disponible temporalmente.');

        auth('usuarios')->login($user, false);
        $request->session()->regenerate();

        return redirect()->route($profile['home']);
    }
}
