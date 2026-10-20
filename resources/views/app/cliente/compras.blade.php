@extends('layouts.cliente')
@section('title', 'Mis compras · Librería Virtual')
@section('content')
<div class="container page-shell">
    <div class="page-heading"><div><p class="eyebrow mb-2">Mi biblioteca</p><h1>Mis compras</h1><p>Consulta el historial y el seguimiento simulado de tus pedidos.</p></div></div>
    @forelse ($compras as $compra)
        <article class="order-card mb-3">
            <div class="order-card-main">
                <div><p class="eyebrow mb-1">Pedido P-{{ sprintf('%05d', $compra->id) }}</p><h2 class="h4 mb-1">S/ {{ number_format($compra->costo_envio + $compra->costo_pedido, 2) }}</h2><p class="small mb-0">Realizado el {{ $compra->fecha }}</p></div>
                <div class="order-status"><span class="status-pill">{{ $compra->estado_envio ?? $compra->estado }}</span><span class="small">Seguimiento simulado: {{ $compra->nro_tracking ?? 'Sin asignar' }}</span>@if ($compra->fecha_llegada)<span class="small">Entregado: {{ $compra->fecha_llegada }}</span>@elseif ($compra->fecha_probable_llegada)<span class="small">Llegada estimada: {{ $compra->fecha_probable_llegada }}</span>@endif</div>
            </div>
            <div class="order-card-actions"><a href="{{ route('cliente.factura', $compra->id) }}" class="btn btn-outline-dark">Ver pedido y seguimiento</a></div>
        </article>
    @empty
        <div class="empty-state" role="status"><h2>Aún no tienes compras</h2><p>Elige un ejemplar y confirma un pedido de demostración para ver su seguimiento aquí.</p><a href="{{ route('cliente.home') }}" class="btn btn-primary">Explorar libros</a></div>
    @endforelse
</div>
@endsection
