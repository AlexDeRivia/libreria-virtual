<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $especialidades = [
            ['especialidad' => 'Novela'],
            ['especialidad' => 'Poesía'],
            ['especialidad' => 'Ingeniería de Sistemas'],
            ['especialidad' => 'Política'],
            ['especialidad' => 'Matemática'],
            ['especialidad' => 'Cocina y Gastronomía'],
            ['especialidad' => 'Educación'],
            ['especialidad' => 'Infantil'],
            ['especialidad' => 'Historia'],
            ['especialidad' => 'Música'],
            ['especialidad' => 'Astronomía'],
        ];

        foreach ($especialidades as $especialidade) {
            Especialidad::create($especialidade);
        }
    }
}
