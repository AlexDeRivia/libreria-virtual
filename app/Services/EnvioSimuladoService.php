<?php

namespace App\Services;

use App\Models\Envio;
use App\Models\EstadoEnvio;
use App\Models\Pedido;
use Illuminate\Validation\ValidationException;

class EnvioSimuladoService
{
    public const PREPARACION = 'En preparación';
    public const EN_CAMINO = 'En camino';
    public const ENTREGADO = 'Entregado';

    public function crearParaPedido(Pedido $pedido): Envio
    {
        if ($pedido->envio_id) {
            return Envio::query()->findOrFail($pedido->envio_id);
        }

        $estado = EstadoEnvio::query()->firstOrCreate(['estado' => self::PREPARACION]);
        $envio = Envio::query()->create([
            'nro_tracking' => sprintf('D%09d', $pedido->id),
            'estado_envio_id' => $estado->id,
        ]);
        $pedido->envio_id = $envio->id;
        $pedido->save();

        return $envio;
    }

    public function despachar(Pedido $pedido, string $fechaProbable): void
    {
        $envio = $this->crearParaPedido($pedido);
        $envio->load('estado');
        if ($envio->estado->estado !== self::PREPARACION) {
            throw ValidationException::withMessages(['envio' => 'El envío ya fue despachado.']);
        }

        $estado = EstadoEnvio::query()->firstOrCreate(['estado' => self::EN_CAMINO]);
        $envio->estado_envio_id = $estado->id;
        $envio->fecha_probable_llegada = $fechaProbable;
        $envio->save();
    }

    public function entregar(Pedido $pedido): void
    {
        $envio = $this->crearParaPedido($pedido);
        $envio->load('estado');
        if ($envio->estado->estado !== self::EN_CAMINO) {
            throw ValidationException::withMessages(['envio' => 'Despacha el envío antes de marcarlo como entregado.']);
        }

        $fecha = now()->toDateString();
        $estado = EstadoEnvio::query()->firstOrCreate(['estado' => self::ENTREGADO]);
        $envio->estado_envio_id = $estado->id;
        $envio->fecha_llegada = $fecha;
        $envio->save();

        $pedido->estado_pedido_id = 3;
        $pedido->entregado = true;
        $pedido->fecha_llegada = $fecha;
        $pedido->save();
    }
}
