<?php

namespace Database\Seeders;

use App\Models\Pais;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paises = [
            ['nombre' => 'Perú'],
            ['nombre' => 'Argentina'],
            ['nombre' => 'Colombia'],
            ['nombre' => 'Chile'],
            ['nombre' => 'Ecuador'],
        ];

        foreach ($paises as $pais) {
            Pais::create($pais);
        }
    }
}
