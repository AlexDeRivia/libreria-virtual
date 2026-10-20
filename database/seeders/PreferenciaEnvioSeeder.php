<?php

namespace Database\Seeders;

use App\Models\PreferenciaEnvio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreferenciaEnvioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preferencias = [
            ['preferencia' => 'Correo normal'],
            ['preferencia' => 'Expreso'],
            ['preferencia' => 'Internacional'],
            ['preferencia' => 'Courier'],
        ];

        foreach ($preferencias as $preferencia) {
            PreferenciaEnvio::create($preferencia);
        }
    }
}
