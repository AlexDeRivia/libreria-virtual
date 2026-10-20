<?php

namespace Database\Seeders;

use App\Models\Nacionalidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NacionalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nacionalidades = [
            ['nacionalidad' => 'Peruana'],
            ['nacionalidad' => 'Argentina'],
            ['nacionalidad' => 'Colombiana'],
            ['nacionalidad' => 'Chilena'],
            ['nacionalidad' => 'Ecuatoriana'],
            ['nacionalidad' => 'Suiza'],
            ['nacionalidad' => 'Canadiense'],
            ['nacionalidad' => 'Estadounidense'],
            ['nacionalidad' => 'Italiana'],
            ['nacionalidad' => 'Cubana'],
            ['nacionalidad' => 'Francesa'],
        ];

        foreach ($nacionalidades as $nacionalidad) {
            Nacionalidad::create($nacionalidad);
        }
    }
}
