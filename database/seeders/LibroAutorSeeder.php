<?php

namespace Database\Seeders;

use App\Models\LibroAutor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibroAutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $liaus = [
            [
                'libro_id' => '1',
                'autor_id' => '1',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '2',
                'autor_id' => '4',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '3',
                'autor_id' => '3',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '4',
                'autor_id' => '13',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '5',
                'autor_id' => '4',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '6',
                'autor_id' => '1',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '7',
                'autor_id' => '4',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '8',
                'autor_id' => '1',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '9',
                'autor_id' => '4',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '10',
                'autor_id' => '4',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '11',
                'autor_id' => '3',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '12',
                'autor_id' => '9',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '13',
                'autor_id' => '14',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '14',
                'autor_id' => '15',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '15',
                'autor_id' => '12',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '16',
                'autor_id' => '10',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '17',
                'autor_id' => '11',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '18',
                'autor_id' => '16',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '18',
                'autor_id' => '17',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '18',
                'autor_id' => '18',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '19',
                'autor_id' => '19',
                'es_principal' => '1',
            ],
            [
                'libro_id' => '20',
                'autor_id' => '20',
                'es_principal' => '1',
            ],
        ];

        foreach ($liaus as $liau) {
            LibroAutor::create($liau);
        }
    }
}
