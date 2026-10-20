<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Ejemplar;
use App\Models\LineaPedido;
use App\Models\Pedido;
use App\Services\EnvioSimuladoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PedidoController extends Controller
{
    public function clic(Request $request)
    {
        $data = $request->validate([
            'ejemplar_id' => 'required|integer|exists:ejemplares,id',
            'cantidad' => 'required|integer|min:1|max:1000',
        ]);

        if (! $this->agregarLinea($data['ejemplar_id'], $data['cantidad'])) {
            return back()->with('error', 'Stock insuficiente')
                ->with('error_for_detail', $data['ejemplar_id']);
        }

        return back();
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|exists:ejemplares,id',
            'cantidad' => 'required|integer|min:1|max:1000',
        ]);

        if (! $this->agregarLinea($data['id'], $data['cantidad'])) {
            return back()->withErrors(['stock_error' => 'El stock es insuficiente'])->withInput();
        }

        return redirect()->route('cliente.pedido');
    }

    private function agregarLinea(int $ejemplarId, int $cantidad): bool
    {
        return DB::transaction(function () use ($ejemplarId, $cantidad) {
            $pedido = $this->pedidoAbierto();
            $ejemplar = Ejemplar::query()->lockForUpdate()->findOrFail($ejemplarId);
            if ($ejemplar->stock < $cantidad) {
                return false;
            }

            $linea = LineaPedido::query()
                ->where('pedido_id', $pedido->id)
                ->where('ejemplar_id', $ejemplar->id)
                ->first();

            if ($linea) {
                $linea->cantidad += $cantidad;
            } else {
                $linea = new LineaPedido([
                    'pedido_id' => $pedido->id,
                    'ejemplar_id' => $ejemplar->id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $ejemplar->precio,
                ]);
            }

            $linea->save();
            $ejemplar->stock -= $cantidad;
            $ejemplar->save();
            $pedido->touch();

            return true;
        });
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'accion' => 'required|in:mas,menos',
        ]);

        $sinStock = DB::transaction(function () use ($data) {
            $pedido = $this->pedidoAbierto();
            $linea = LineaPedido::query()
                ->where('pedido_id', $pedido->id)
                ->lockForUpdate()
                ->findOrFail($data['id']);
            $ejemplar = Ejemplar::query()->lockForUpdate()->findOrFail($linea->ejemplar_id);

            if ($data['accion'] === 'mas') {
                if ($ejemplar->stock < 1) {
                    return true;
                }
                $linea->cantidad++;
                $ejemplar->stock--;
            } elseif ($linea->cantidad > 1) {
                $linea->cantidad--;
                $ejemplar->stock++;
            }

            $linea->save();
            $ejemplar->save();
            $pedido->touch();
            return false;
        });

        if ($sinStock) {
            return redirect()->route('cliente.pedido')
                ->with('error', 'Stock insuficiente')
                ->with('error_for_detail', $data['id']);
        }

        return redirect()->route('cliente.pedido');
    }

    public function destroy(string $id)
    {
        DB::transaction(function () use ($id) {
            $pedido = $this->pedidoAbierto();
            $linea = LineaPedido::query()
                ->where('pedido_id', $pedido->id)
                ->lockForUpdate()
                ->findOrFail($id);
            $ejemplar = Ejemplar::query()->lockForUpdate()->findOrFail($linea->ejemplar_id);

            $ejemplar->stock += $linea->cantidad;
            $ejemplar->save();
            $linea->delete();
            $pedido->touch();
        });

        return redirect()->route('cliente.pedido');
    }

    public function pay(Request $request, EnvioSimuladoService $envios)
    {
        $data = $request->validate([
            'preferencia_envio_id' => 'required|integer|exists:preferencia_envios,id',
            'empaquetado' => 'required|boolean',
            'direccion_adicional' => 'required_if:empaquetado,1|nullable|string|max:255',
            'mensaje' => 'nullable|string|max:2000',
        ]);

        DB::transaction(function () use ($data, $envios) {
            $pedido = $this->pedidoAbierto();
            $lineas = $pedido->lineaPedidos()->get();
            if ($lineas->isEmpty()) {
                throw ValidationException::withMessages(['pedido' => 'El pedido está vacío.']);
            }

            $pedido->fecha = now()->toDateString();
            $pedido->empaquetado = (bool) $data['empaquetado'];
            $pedido->costo_envio = $lineas->sum('cantidad') * 0.5;
            $pedido->preferencia_envio_id = $data['preferencia_envio_id'];
            $pedido->estado_pedido_id = 2;
            $pedido->save();
            $envios->crearParaPedido($pedido);

            if ($pedido->empaquetado) {
                DB::table('direcciones')->insert([
                    'id' => $pedido->id,
                    'direccion' => $data['direccion_adicional'],
                    'mensaje' => $data['mensaje'] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            Pedido::create([
                'usuario_id' => auth('usuarios')->id(),
                'empaquetado' => false,
                'estado_pedido_id' => 1,
            ]);
        });

        return redirect()->route('cliente.compras');
    }

    private function pedidoAbierto(): Pedido
    {
        return Pedido::query()
            ->where('usuario_id', auth('usuarios')->id())
            ->where('estado_pedido_id', 1)
            ->lockForUpdate()
            ->firstOrFail();
    }
}
