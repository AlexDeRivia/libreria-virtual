<?php

namespace Database\Seeders;

use App\Models\EstadoPedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            ["estado" => "No confirmado"],
            ["estado" => "Confirmado"],
            ["estado" => "Entregado"],
        ];

        foreach ($estados as $estado) {
            EstadoPedido::create($estado);
        }
    }
}
