<?php

namespace Database\Seeders;

use App\Models\Idioma;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdiomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $idiomas = [
            ['idioma' => 'Español'],
            ['idioma' => 'Inglés'],
            ['idioma' => 'Francés'],
            ['idioma' => 'Portugués'],
            ['idioma' => 'Chino'],
            ['idioma' => 'Japonés'],
            ['idioma' => 'Italiano'],
        ];

        foreach ($idiomas as $idioma) {
            Idioma::create($idioma);
        }
    }
}
