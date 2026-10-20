<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = $this->pedidosConSeguimiento()->get();
        return view('app.admin.pedidos', compact('pedidos'));
    }

    public function show(string $id)
    {
        $pedido = $this->pedidosConSeguimiento()->where('view_pedidos.id', $id)->first();
        abort_unless($pedido, 404);
        $lineas = DB::table('view_linea_pedidos')->where('pedido_id', $id)->get();

        return view('app.admin.pedido', compact('pedido', 'lineas'));
    }

    private function pedidosConSeguimiento()
    {
        return DB::table('view_pedidos')
            ->leftJoin('envios', 'view_pedidos.envio_id', '=', 'envios.id')
            ->leftJoin('estado_envios', 'envios.estado_envio_id', '=', 'estado_envios.id')
            ->select('view_pedidos.*', 'envios.nro_tracking', 'envios.fecha_probable_llegada', 'estado_envios.estado as estado_envio');
    }
}
