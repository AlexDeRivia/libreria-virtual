<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $password = config('demo.public_access') ? Str::random(48) : env('DEMO_PASSWORD');
        if (! is_string($password) || strlen($password) < 12) {
            throw new \RuntimeException('DEMO_PASSWORD debe tener al menos 12 caracteres para cargar usuarios de demostración.');
        }

        $hash = Hash::make($password);
        $usuarios = [
            ['email' => 'admin@example.test', 'nombres' => 'Admin', 'apellidos' => 'Demo', 'rol_id' => 1],
            ['email' => 'cliente@example.test', 'nombres' => 'Cliente', 'apellidos' => 'Demo', 'rol_id' => 2],
            ['email' => 'especialista@example.test', 'nombres' => 'Especialista', 'apellidos' => 'Demo', 'rol_id' => 3],
            ['email' => 'envios@example.test', 'nombres' => 'Encargado', 'apellidos' => 'Demo', 'rol_id' => 4],
            ['email' => 'cliente2@example.test', 'nombres' => 'Cliente Dos', 'apellidos' => 'Demo', 'rol_id' => 3],
        ];

        foreach ($usuarios as $index => $usuario) {
            Usuario::create($usuario + [
                'password' => $hash,
                'email_verified_at' => now(),
                'telefono' => sprintf('900000%03d', $index + 1),
                'pedido_1_clic' => false,
                'pais_id' => 1,
                'provincia_id' => 2,
                'localidad' => 'Ciudad de ejemplo',
                'direccion' => 'Dirección de demostración',
                'codigo_postal' => '00000',
            ]);
        }
    }
}
