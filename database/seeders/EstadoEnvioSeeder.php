<?php

namespace Database\Seeders;

use App\Models\EstadoEnvio;
use App\Services\EnvioSimuladoService;
use Illuminate\Database\Seeder;

class EstadoEnvioSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([EnvioSimuladoService::PREPARACION, EnvioSimuladoService::EN_CAMINO, EnvioSimuladoService::ENTREGADO] as $estado) {
            EstadoEnvio::query()->firstOrCreate(['estado' => $estado]);
        }
    }
}
