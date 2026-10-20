@extends('layouts.home')
@section('title', 'Catálogo · Librería Virtual')
@section('content')
<div class="container page-shell">
    <div class="page-heading">
        <div><p class="eyebrow mb-2">Catálogo abierto</p><h1>Encuentra tu próxima lectura</h1><p>Explora libros sin registrarte. Los precios, pedidos y envíos forman parte de la demostración.</p></div>
        <form method="get" action="{{ route('catalogo.index') }}" class="catalog-search" role="search">
            <label class="visually-hidden" for="query">Buscar por título o autor</label>
            <input id="query" class="form-control" type="search" name="query" value="{{ $query }}" placeholder="Título o autor…" autocomplete="off">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </form>
    </div>
    @if ($ejemplares->isEmpty())
        <div class="empty-state" role="status"><h2>No encontramos ejemplares</h2><p>Prueba con otro título o apellido de autor.</p><a href="{{ route('catalogo.index') }}" class="btn btn-outline-dark">Ver todo el catálogo</a></div>
    @else
        <div class="book-grid">
            @foreach ($ejemplares as $ejemplar)
                <article class="book-card">
                    <div class="book-cover" aria-hidden="true"><div class="book-cover-inner">{{ $ejemplar->titulo }}</div></div>
                    <div class="book-card-body">
                        <h2>{{ $ejemplar->titulo }}</h2>
                        <p class="book-author">{{ $ejemplar->autores }}</p>
                        <div class="book-meta"><span>{{ $ejemplar->idioma }}</span><strong>S/ {{ number_format($ejemplar->precio, 2) }}</strong></div>
                        <p class="small mb-3">{{ $ejemplar->stock }} disponibles</p>
                        <a class="btn btn-outline-dark" href="{{ route('catalogo.show', $ejemplar->id) }}" aria-label="Ver detalle de {{ $ejemplar->titulo }}">Ver detalle</a>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</div>
@endsection
