<?php

namespace Database\Seeders;

use App\Models\LibroEspecialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibroEspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $liesps = [
            [
                'libro_id' => '1',
                'especialidad_id' => '1',
            ],
            [
                'libro_id' => '2',
                'especialidad_id' => '1',
            ],
            [
                'libro_id' => '3',
                'especialidad_id' => '1',
            ],
            [
                'libro_id' => '4',
                'especialidad_id' => '1',
            ],
            [
                'libro_id' => '5',
                'especialidad_id' => '1',
            ],
            [
                'libro_id' => '6',
                'especialidad_id' => '1',
            ],
            [
                'libro_id' => '7',
                'especialidad_id' => '1',
            ],
            [
                'libro_id' => '8',
                'especialidad_id' => '1',
            ],
            [
                'libro_id' => '9',
                'especialidad_id' => '1',
            ],
            [
                'libro_id' => '10',
                'especialidad_id' => '1',
            ],
            [
                'libro_id' => '11',
                'especialidad_id' => '1',
            ],
            [
                'libro_id' => '12',
                'especialidad_id' => '3',
            ],
            [
                'libro_id' => '13',
                'especialidad_id' => '3',
            ],
            [
                'libro_id' => '14',
                'especialidad_id' => '3',
            ],
            [
                'libro_id' => '15',
                'especialidad_id' => '4',
            ],
            [
                'libro_id' => '16',
                'especialidad_id' => '4',
            ],
            [
                'libro_id' => '17',
                'especialidad_id' => '6',
            ],
            [
                'libro_id' => '18',
                'especialidad_id' => '6',
            ],
            [
                'libro_id' => '19',
                'especialidad_id' => '6',
            ],
            [
                'libro_id' => '20',
                'especialidad_id' => '6',
            ],
        ];

        foreach ($liesps as $le) {
            LibroEspecialidad::create($le);
        }
    }
}
