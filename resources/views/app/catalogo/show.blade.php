@extends('layouts.home')
@section('title', $ejemplar->titulo . ' · Librería Virtual')
@section('content')
<div class="container page-shell">
    <a href="{{ route('catalogo.index') }}" class="d-inline-block mb-4">← Volver al catálogo</a>
    <article class="book-detail">
        <div class="book-cover" aria-hidden="true"><div class="book-cover-inner">{{ $ejemplar->titulo }}</div></div>
        <div class="book-detail-content">
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
            <div class="action-panel"><p class="mb-3">{{ config('demo.public_access') ? 'Entra como cliente para añadir este ejemplar a tu pedido de demostración.' : 'Crea una cuenta de cliente con datos ficticios para añadir este ejemplar a tu pedido.' }}</p><a class="btn btn-primary" href="{{ config('demo.public_access') ? route('login') : route('register') }}">{{ config('demo.public_access') ? 'Elegir un rol' : 'Crear cuenta de demostración' }}</a></div>
        </div>
    </article>
</div>
@endsection
