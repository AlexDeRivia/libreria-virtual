@extends('layouts.cliente')
@section('title', $ejemplar->titulo . ' · Mi biblioteca')
@section('content')
<div class="container page-shell">
    <a href="{{ route('cliente.home') }}" class="d-inline-block mb-4">← Volver al catálogo</a>
    <article class="book-detail">
        <div class="book-cover" aria-hidden="true"><div class="book-cover-inner">{{ $ejemplar->titulo }}</div></div>
        <div class="book-detail-content">
            @if ($errors->has('stock_error'))<div class="alert alert-danger" role="alert">{{ $errors->first('stock_error') }}</div>@endif
            <p class="eyebrow mb-2">Ficha del ejemplar</p>
            <h1>{{ $ejemplar->titulo }}</h1>
            <p class="lead mb-4">{{ $ejemplar->autores }}</p>
            <p>{{ $ejemplar->resumen }}</p>
            <dl class="book-facts">
                <div><dt>ISBN</dt><dd>{{ $ejemplar->isbn }}</dd></div>
                <div><dt>Idioma</dt><dd>{{ $ejemplar->idioma }}</dd></div>
                <div><dt>Ejemplar</dt><dd>{{ $ejemplar->numero_ejemplar }}</dd></div>
                <div><dt>Disponibles</dt><dd>{{ $ejemplar->stock }}</dd></div>
                <div><dt>Precio simulado</dt><dd>S/ {{ number_format($ejemplar->precio, 2) }}</dd></div>
            </dl>
            <form action="{{ route('cliente.pedido.add') }}" method="post" class="action-panel">
                @csrf
                <input type="hidden" name="id" value="{{ $ejemplar->id }}">
                <p class="mb-3">Reserva este ejemplar durante 30 minutos mientras preparas tu pedido.</p>
                <div class="d-flex flex-wrap align-items-end gap-3">
                    <div><label for="cantidad" class="form-label">Cantidad</label><input id="cantidad" class="form-control" name="cantidad" type="number" value="{{ old('cantidad', 1) }}" min="1" style="max-width: 7rem" required></div>
                    <button class="btn btn-primary" type="submit">Añadir al pedido</button>
                </div>
            </form>
        </div>
    </article>
</div>
@endsection
