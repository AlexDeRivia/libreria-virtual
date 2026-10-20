<?php

namespace Database\Seeders;

use App\Models\Autor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $autores = [
            [
                'nombres' => 'Mario',
                'apellidos' => 'Vargas Llosa',
                'nacionalidad_id' => '1',
            ],
            [
                'nombres' => 'Ciro',
                'apellidos' => 'Alegría',
                'nacionalidad_id' => '1',
            ],
            [
                'nombres' => 'Ernesto',
                'apellidos' => 'Sabato',
                'nacionalidad_id' => '2',
            ],
            [
                'nombres' => 'Gabriel',
                'apellidos' => 'García Marquez',
                'nacionalidad_id' => '3',
            ],
            [
                'nombres' => 'Erich',
                'apellidos' => 'Gamma',
                'nacionalidad_id' => '6',
            ],
            [
                'nombres' => 'Richard',
                'apellidos' => 'helm',
                'nacionalidad_id' => '7',
            ],
            [
                'nombres' => 'Ralph',
                'apellidos' => 'Johnson',
                'nacionalidad_id' => '8',
            ],
            [
                'nombres' => 'John',
                'apellidos' => 'Vlissides',
                'nacionalidad_id' => '8',
            ],
            [
                'nombres' => 'Robert',
                'apellidos' => 'C. Martin',
                'nacionalidad_id' => '8',
            ],
            [
                'nombres' => 'John',
                'apellidos' => 'Dewey',
                'nacionalidad_id' => '8',
            ],
            [
                'nombres' => 'Nitza',
                'apellidos' => 'Villapol',
                'nacionalidad_id' => '10',
            ],
            [
                'nombres' => 'Nicolás',
                'apellidos' => 'Maquiavelo',
                'nacionalidad_id' => '9',
            ],
            [
                'nombres' => 'Julio',
                'apellidos' => 'Cortázar',
                'nacionalidad_id' => '2',
            ],
            [
                'nombres' => 'Donald',
                'apellidos' => 'E. Knuth',
                'nacionalidad_id' => '8',
            ],
            [
                'nombres' => 'Michael',
                'apellidos' => 'Sipser',
                'nacionalidad_id' => '8',
            ],
            [
                'nombres' => 'Julia',
                'apellidos' => 'Child',
                'nacionalidad_id' => '8',
            ],
            [
                'nombres' => 'Louisette',
                'apellidos' => 'Bertholle',
                'nacionalidad_id' => '11',
            ],
            [
                'nombres' => 'Simone',
                'apellidos' => 'Beck',
                'nacionalidad_id' => '11',
            ],
            [
                'nombres' => 'Irma',
                'apellidos' => 'S. Rombauer',
                'nacionalidad_id' => '11',
            ],
            [
                'nombres' => 'J. Kenji',
                'apellidos' => 'López-Alt',
                'nacionalidad_id' => '11',
            ],
        ];

        foreach ($autores as $autor) {
            Autor::create($autor);
        }
    }
}
