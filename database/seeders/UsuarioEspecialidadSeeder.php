<?php

namespace Database\Seeders;

use App\Models\UsuarioEspecialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioEspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuesps = [
            [
                'usuario_id' => '3',
                'especialidad_id' => '3',
            ],
        ];

        foreach ($usuesps as $usues) {
            UsuarioEspecialidad::create($usues);
        }
    }
}
