<?php

namespace App\Http\Controllers\Encargado;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Services\EnvioSimuladoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $pedidos = $this->pedidosConSeguimiento()
            ->whereIn('view_pedidos.estado_pedido_id', [2, 3])
            ->get();
        return view('app.encargado.home', compact('pedidos'));
    }

    public function show(string $id)
    {
        $pedido = $this->pedidosConSeguimiento()
            ->whereIn('view_pedidos.estado_pedido_id', [2, 3])
            ->where('view_pedidos.id', $id)
            ->first();
        abort_unless($pedido, 404);
        $lineas = DB::table('view_linea_pedidos')->where('pedido_id', $id)->get();

        return view('app.encargado.pedido', compact('pedido', 'lineas'));
    }

    public function despachar(Request $request, string $id, EnvioSimuladoService $envios)
    {
        $data = $request->validate([
            'fecha_probable_llegada' => 'required|date|after_or_equal:today',
        ]);

        DB::transaction(function () use ($id, $data, $envios) {
            $pedido = Pedido::query()
                ->where('estado_pedido_id', 2)
                ->where('entregado', false)
                ->lockForUpdate()
                ->findOrFail($id);
            $envios->despachar($pedido, $data['fecha_probable_llegada']);
        });

        return back();
    }

    public function entregar(string $id, EnvioSimuladoService $envios)
    {
        DB::transaction(function () use ($id, $envios) {
            $pedido = Pedido::query()
                ->where('estado_pedido_id', 2)
                ->where('entregado', false)
                ->lockForUpdate()
                ->findOrFail($id);
            $envios->entregar($pedido);
        });

        return back();
    }

    private function pedidosConSeguimiento()
    {
        return DB::table('view_pedidos')
            ->leftJoin('envios', 'view_pedidos.envio_id', '=', 'envios.id')
            ->leftJoin('estado_envios', 'envios.estado_envio_id', '=', 'estado_envios.id')
            ->select('view_pedidos.*', 'envios.nro_tracking', 'envios.fecha_probable_llegada', 'estado_envios.estado as estado_envio');
    }
}
