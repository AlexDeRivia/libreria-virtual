<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provincias = [

            ['pais_id' => '1', 'nombre' => 'Lima'],
            ['pais_id' => '1', 'nombre' => 'Santa'],
            ['pais_id' => '1', 'nombre' => 'Trujillo'],
            ['pais_id' => '1', 'nombre' => 'Piura'],
            ['pais_id' => '1', 'nombre' => 'Chiclayo'],
            ['pais_id' => '1', 'nombre' => 'Cusco'],

            ['pais_id' => '2', 'nombre' => 'Buenos Aires'],
            ['pais_id' => '2', 'nombre' => 'Córdoba'],
            ['pais_id' => '2', 'nombre' => 'Santa Fe'],
            ['pais_id' => '2', 'nombre' => 'Mendoza'],
            ['pais_id' => '2', 'nombre' => 'Tucumán'],

            ['pais_id' => '3', 'nombre' => 'Bogotá'],
            ['pais_id' => '3', 'nombre' => 'Medellín'],
            ['pais_id' => '3', 'nombre' => 'Cali'],

            ['pais_id' => '4', 'nombre' => 'Santiago'],
            ['pais_id' => '4', 'nombre' => 'Valparaíso'],
            ['pais_id' => '4', 'nombre' => 'Cali'],

            ['pais_id' => '5', 'nombre' => 'Guayaquil'],
            ['pais_id' => '5', 'nombre' => 'Quito'],
        ];

        foreach ($provincias as $provincia) {
            Provincia::create($provincia);
        }
    }
}
