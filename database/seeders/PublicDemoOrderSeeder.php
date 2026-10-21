<?php

namespace Database\Seeders;

use App\Models\Ejemplar;
use App\Models\LineaPedido;
use App\Models\Pedido;
use App\Models\Usuario;
use App\Services\EnvioSimuladoService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicDemoOrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $client = Usuario::query()->where('email', 'cliente@example.test')->firstOrFail();
            $copy = Ejemplar::query()->where('numero_ejemplar', '1001')->firstOrFail();
            $order = Pedido::query()
                ->where('usuario_id', $client->id)
                ->where('estado_pedido_id', 1)
                ->firstOrFail();

            $copy->decrement('stock');
            LineaPedido::query()->create([
                'pedido_id' => $order->id,
                'ejemplar_id' => $copy->id,
                'cantidad' => 1,
                'precio_unitario' => $copy->precio,
            ]);
            $order->update([
                'fecha' => now()->toDateString(),
                'empaquetado' => false,
                'estado_pedido_id' => 2,
                'costo_envio' => 0.5,
                'preferencia_envio_id' => 1,
            ]);
            app(EnvioSimuladoService::class)->crearParaPedido($order);
            Pedido::query()->create([
                'usuario_id' => $client->id,
                'empaquetado' => false,
                'estado_pedido_id' => 1,
            ]);
        });
    }
}
