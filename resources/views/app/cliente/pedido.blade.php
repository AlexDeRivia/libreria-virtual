@extends('layouts.cliente')
@section('title', 'Mi pedido · Librería Virtual')
@section('content')
<div class="container page-shell">
    <div class="page-heading"><div><p class="eyebrow mb-2">Pedido de demostración</p><h1>Mi pedido</h1><p>Revisa los ejemplares antes de confirmar la compra simulada.</p></div><a href="{{ route('cliente.home') }}" class="btn btn-outline-dark">Seguir explorando</a></div>
    <div class="alert alert-info">Los ejemplares se reservan durante 30 minutos desde el último cambio. Después vuelven a estar disponibles.</div>
    @if ($lineas->count() > 0)
        <div class="checkout-grid">
            <div>
                <h2 class="h4 mb-3">Ejemplares seleccionados</h2>
                @foreach ($lineas as $detalle)
                    <article class="cart-item mb-3">
                        <div class="cart-item-copy"><h3 class="h5 mb-1"><a href="{{ route('cliente.ejemplar', $detalle->ejemplar_id) }}">{{ $detalle->titulo }}</a></h3><p class="small mb-1">Precio unitario S/ {{ number_format($detalle->precio_unitario, 2) }}</p><strong>Subtotal S/ {{ number_format($detalle->subtotal, 2) }}</strong></div>
                        <div class="cart-item-controls">
                            <form action="{{ route('cliente.pedido.update') }}" method="post" class="d-flex align-items-center gap-1">
                                @csrf @method('put')
                                <input type="hidden" name="ejemplar_id" value="{{ $detalle->ejemplar_id }}"><input type="hidden" name="id" value="{{ $detalle->id }}">
                                <button class="btn btn-outline-dark" type="submit" name="accion" value="menos" aria-label="Quitar una unidad de {{ $detalle->titulo }}">−</button>
                                <output class="cart-quantity" aria-label="{{ $detalle->cantidad }} unidades">{{ $detalle->cantidad }}</output>
                                <button class="btn btn-outline-dark" type="submit" name="accion" value="mas" aria-label="Añadir una unidad de {{ $detalle->titulo }}">+</button>
                            </form>
                            <form action="{{ route('cliente.pedido.destroy', $detalle->id) }}" method="post">@csrf @method('delete')<input type="hidden" name="id" value="{{ $detalle->id }}"><button class="btn btn-link link-danger" type="submit" aria-label="Quitar {{ $detalle->titulo }} del pedido">Quitar</button></form>
                        </div>
                    </article>
                    @if (session('error') && session('error_for_detail') == $detalle->id)<div class="alert alert-danger" role="alert">{{ session('error') }}</div>@endif
                @endforeach
            </div>
            <aside class="checkout-summary" aria-labelledby="summary-title">
                <h2 id="summary-title" class="h4">Resumen del pedido</h2>
                <dl><div><dt>Ejemplares</dt><dd>S/ {{ number_format($total, 2) }}</dd></div><div><dt>Envío simulado</dt><dd>S/ {{ number_format($envio, 2) }}</dd></div><div class="summary-total"><dt>Total</dt><dd>S/ {{ number_format($total + $envio, 2) }}</dd></div></dl>
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#confirmarPedido">Confirmar pedido</button>
                <p class="small mt-3 mb-0">No se realizará ningún cobro real.</p>
            </aside>
        </div>
    @else
        <div class="empty-state" role="status"><h2>Tu pedido está vacío</h2><p>Explora el catálogo y añade un ejemplar para empezar.</p><a href="{{ route('cliente.home') }}" class="btn btn-primary">Explorar libros</a></div>
    @endif
</div>
@if ($lineas->count() > 0)
<form action="{{ route('cliente.pedido.pay') }}" method="post" class="needs-validation" autocomplete="off" novalidate>
    @csrf
    <div class="modal fade" id="confirmarPedido" tabindex="-1" aria-labelledby="confirmarTitulo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"><div class="modal-content">
            <div class="modal-header"><h2 class="modal-title h5" id="confirmarTitulo">Confirmar pedido simulado</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>
            <div class="modal-body">
                <div class="alert alert-info">Pedido de demostración: no se realizará ningún cobro.</div>
                <div class="row g-3">
                    <div class="col-md-6"><label for="fecha" class="form-label">Fecha de pedido</label><input type="date" class="form-control" id="fecha" value="{{ $fecha }}" disabled></div>
                    <div class="col-md-6"><label for="costo_final" class="form-label">Costo total</label><input type="text" class="form-control" id="costo_final" value="S/ {{ number_format($envio + $total, 2) }}" disabled></div>
                    <div class="col-md-6"><label for="preferencia_envio_id" class="form-label">Preferencia de envío</label><select id="preferencia_envio_id" name="preferencia_envio_id" class="form-select" required><option value="">Selecciona una opción</option>@foreach ($preferencias as $preferencia)<option value="{{ $preferencia->id }}">{{ $preferencia->preferencia }}</option>@endforeach</select><div class="invalid-feedback">Selecciona una preferencia de envío.</div></div>
                    <div class="col-md-6"><label for="empaquetado" class="form-label">Empaquetado</label><select id="empaquetado" name="empaquetado" class="form-select" required><option value="">Selecciona una opción</option><option value="0">Estándar</option><option value="1">Regalo</option></select><div class="invalid-feedback">Selecciona un tipo de empaquetado.</div></div>
                    <div class="col-md-6" id="direccion_adicional_container" hidden><label for="direccion_adicional" class="form-label">Dirección adicional</label><input type="text" class="form-control" id="direccion_adicional" name="direccion_adicional" autocomplete="off"></div>
                    <div class="col-12" id="mensaje_container" hidden><label for="mensaje" class="form-label">Mensaje para el regalo</label><textarea class="form-control" id="mensaje" name="mensaje" rows="3" autocomplete="off"></textarea></div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver al pedido</button><button type="submit" class="btn btn-primary">Confirmar compra simulada</button></div>
        </div></div>
    </div>
</form>
<script>
document.getElementById('empaquetado')?.addEventListener('change', function () {
    const regalo = this.value === '1';
    for (const id of ['direccion_adicional', 'mensaje']) {
        const field = document.getElementById(id);
        field.required = regalo;
        field.closest('[id$="_container"]').hidden = !regalo;
    }
});
</script>
@endif
@endsection
