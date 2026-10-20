@extends('layouts.encargado')
@section('title', 'Gestión de envíos · Librería Virtual')
@section('content')
<div class="container page-shell">
    <div class="page-heading"><div><p class="eyebrow mb-2">Operación de demostración</p><h1>Envíos por gestionar</h1><p>Prepara, despacha y registra la entrega de cada pedido simulado.</p></div></div>
    @if ($errors->any())<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>@endif
    @forelse ($pedidos as $pedido)
        <article class="order-card mb-3">
            <div class="order-card-main">
                <div><p class="eyebrow mb-1">Pedido P-{{ sprintf('%05d', $pedido->id) }}</p><h2 class="h4 mb-1">{{ $pedido->nombre_usuario }}</h2><p class="mb-1">{{ $pedido->direccion }}</p><p class="small mb-0">{{ $pedido->telefono }} · {{ $pedido->preferencia }}</p></div>
                <div class="order-status"><span class="status-pill">{{ $pedido->estado_envio ?? 'En preparación' }}</span><span class="small">{{ $pedido->nro_tracking ?? 'Sin código de seguimiento' }}</span><span class="small">{{ $pedido->fecha }}</span></div>
            </div>
            <div class="order-card-actions">
                <a href="{{ route('encargado.pedidos.show', $pedido->id) }}" class="btn btn-outline-dark">Ver detalle</a>
                @if ($pedido->estado_pedido_id == 3)
                    <span class="badge bg-success">Entregado</span>
                @elseif ($pedido->estado_envio === 'En camino')
                    <form action="{{ route('encargado.entregar', $pedido->id) }}" method="post">@csrf <button type="submit" class="btn btn-primary">Marcar entregado</button></form>
                @else
                    <form action="{{ route('encargado.despachar', $pedido->id) }}" method="post" class="d-flex flex-wrap align-items-end gap-2">
                        @csrf
                        <div><label for="fecha-{{ $pedido->id }}" class="form-label mb-1">Llegada estimada</label><input id="fecha-{{ $pedido->id }}" type="date" name="fecha_probable_llegada" class="form-control" value="{{ now()->addDays(3)->toDateString() }}" min="{{ now()->toDateString() }}" required></div>
                        <button type="submit" class="btn btn-primary">Marcar en camino</button>
                    </form>
                @endif
            </div>
        </article>
    @empty
        <div class="empty-state" role="status"><h2>No hay pedidos pendientes</h2><p>Los pedidos nuevos aparecerán aquí cuando un cliente confirme una compra de demostración.</p></div>
    @endforelse
</div>
@endsection
