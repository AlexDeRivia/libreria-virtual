<?php

namespace App\Services;

use App\Models\Ejemplar;
use App\Models\LineaPedido;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class CartExpirationService
{
    public const MINUTES = 30;

    public function releaseExpired(): void
    {
        $cutoff = now()->subMinutes(self::MINUTES);

        $ids = Pedido::query()
            ->where('estado_pedido_id', 1)
            ->where('updated_at', '<', $cutoff)
            ->whereHas('lineaPedidos')
            ->pluck('id');

        foreach ($ids as $id) {
            DB::transaction(function () use ($id, $cutoff) {
                $pedido = Pedido::query()->lockForUpdate()->find($id);
                if (! $pedido || $pedido->estado_pedido_id !== 1 || $pedido->updated_at >= $cutoff) {
                    return;
                }

                $lineas = LineaPedido::query()
                    ->where('pedido_id', $pedido->id)
                    ->orderBy('ejemplar_id')
                    ->lockForUpdate()
                    ->get();

                foreach ($lineas as $linea) {
                    $ejemplar = Ejemplar::query()->lockForUpdate()->findOrFail($linea->ejemplar_id);
                    $ejemplar->stock += $linea->cantidad;
                    $ejemplar->save();
                    $linea->delete();
                }

                $pedido->touch();
            });
        }
    }
}
