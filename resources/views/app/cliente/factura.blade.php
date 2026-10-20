@extends('layouts.cliente')
@section('title', 'Detalle del pedido · Librería Virtual')
@section('content')
<div class="container page-shell">
    <a href="{{ route('cliente.compras') }}" class="d-inline-block mb-4">← Volver a mis compras</a>
    <div class="page-heading"><div><p class="eyebrow mb-2">Pedido de demostración</p><h1>P-{{ sprintf('%05d', $compra->id) }}</h1><p>Consulta los ejemplares y el estado del envío simulado.</p></div><span class="status-pill">{{ $compra->estado_envio ?? $compra->estado }}</span></div>
    <div class="checkout-grid">
        <div class="card"><div class="card-header">Ejemplares del pedido</div><div class="card-body"><div class="table-responsive"><table class="table mb-0"><thead><tr><th>Libro</th><th class="text-end">Cantidad</th><th class="text-end">Precio</th><th class="text-end">Subtotal</th></tr></thead><tbody>@foreach ($lineas as $linea)<tr><td><a href="{{ route('cliente.ejemplar', $linea->ejemplar_id) }}">{{ $linea->titulo }}</a></td><td class="text-end">{{ $linea->cantidad }}</td><td class="text-end">S/ {{ number_format($linea->precio_unitario, 2) }}</td><td class="text-end">S/ {{ number_format($linea->subtotal, 2) }}</td></tr>@endforeach</tbody></table></div></div></div>
        <aside class="checkout-summary"><h2 class="h4">Resumen</h2><dl><div><dt>Cliente</dt><dd>{{ $compra->nombre_usuario }}</dd></div><div><dt>Fecha</dt><dd>{{ $compra->fecha }}</dd></div><div><dt>Dirección</dt><dd>{{ $compra->direccion }}</dd></div><div><dt>Estado del pedido</dt><dd>{{ $compra->estado }}</dd></div><div><dt>Seguimiento simulado</dt><dd>{{ $compra->nro_tracking ?? 'Sin asignar' }}</dd></div><div><dt>Llegada estimada</dt><dd>{{ $compra->fecha_probable_llegada ?? 'Sin definir' }}</dd></div><div><dt>Entrega registrada</dt><dd>{{ $compra->fecha_llegada ?? 'Pendiente' }}</dd></div><div><dt>Ejemplares</dt><dd>S/ {{ number_format($compra->costo_pedido, 2) }}</dd></div><div><dt>Envío</dt><dd>S/ {{ number_format($compra->costo_envio, 2) }}</dd></div><div class="summary-total"><dt>Total</dt><dd>S/ {{ number_format($compra->costo_pedido + $compra->costo_envio, 2) }}</dd></div></dl></aside>
    </div>
</div>
@endsection
