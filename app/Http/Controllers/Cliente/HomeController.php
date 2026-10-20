<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\PreferenciaEnvio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home(Request $busqueda)
    {
        $query = $busqueda->filled('query') ? $busqueda->input('query') : '';
        $usuario = auth('usuarios')->user();

        if ($usuario->rol_id == 2) {
            $ejemplares = DB::table('view_all_ejemplares')
                ->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('titulo', 'like', '%' . $query . '%')
                        ->orWhere('autores', 'like', '%' . $query . '%');
                })
                ->get();
        } else {
            $ejemplares = DB::select('CALL sp_ejemplares_por_especialidad(?, ?)', [$usuario->id, $query]);
        }

        return view('app.cliente.home', compact('ejemplares', 'query', 'usuario'));
    }

    public function ejemplar(string $id)
    {
        $ejemplar = DB::table('view_all_ejemplares')
            ->where('id', $id)->first();
        abort_unless($ejemplar, 404);
        return view('app.cliente.ejemplar', compact('ejemplar'));
    }

    public function pedido()
    {
        $usuario = auth('usuarios')->user();
        $pedido_id = Pedido::where('usuario_id', $usuario->id)->where('estado_pedido_id', 1)->first()->id;

        $lineas = DB::table('view_linea_pedidos')
            ->where('pedido_id', $pedido_id)
            ->get();

        $total = 0;
        $envio = 0;
        $fecha = date("Y-m-d");
        $preferencias = PreferenciaEnvio::all();

        foreach ($lineas as $i) {
            $total += $i->subtotal;
            $envio += $i->cantidad * 0.5;
        }

        return view('app.cliente.pedido', compact('lineas', 'total', 'envio', 'fecha', 'preferencias'));
    }

    public function compras()
    {
        $compras = $this->comprasConSeguimiento()
            ->whereIn('view_pedidos.estado_pedido_id', [2, 3])
            ->where('usuario_id', auth('usuarios')->id())
            ->get();
        return view('app.cliente.compras', compact('compras'));
    }

    public function factura(string $id)
    {
        $compra = $this->comprasConSeguimiento()
            ->whereIn('view_pedidos.estado_pedido_id', [2, 3])
            ->where('usuario_id', auth('usuarios')->id())
            ->where('view_pedidos.id', $id)
            ->first();
        abort_unless($compra, 404);
        $lineas = DB::table('view_linea_pedidos')
            ->where('pedido_id', $id)
            ->get();
        return view('app.cliente.factura', compact('compra', 'lineas'));
    }

    private function comprasConSeguimiento()
    {
        return DB::table('view_pedidos')
            ->leftJoin('envios', 'view_pedidos.envio_id', '=', 'envios.id')
            ->leftJoin('estado_envios', 'envios.estado_envio_id', '=', 'estado_envios.id')
            ->select('view_pedidos.*', 'envios.nro_tracking', 'envios.fecha_probable_llegada', 'estado_envios.estado as estado_envio');
    }
}
