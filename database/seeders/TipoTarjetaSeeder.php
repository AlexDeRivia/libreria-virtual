<?php

namespace Database\Seeders;

use App\Models\TipoTarjeta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoTarjetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['tipo' => 'Visa'],
            ['tipo' => 'MasterCard'],
            ['tipo' => 'BBVA Continental'],
        ];

        foreach ($tipos as $tipo) {
            TipoTarjeta::create($tipo);
        }
    }
}
