@extends('layouts.cliente')
@section('title', 'Catálogo · Mi biblioteca')
@section('content')
<div class="container page-shell">
    <div class="page-heading">
        <div><p class="eyebrow mb-2">Mi biblioteca</p><h1>Elige tu próxima lectura</h1><p>Consulta los ejemplares y prepara tu pedido de demostración.</p></div>
        <form action="{{ route('cliente.home') }}" method="get" class="catalog-search" role="search">
            <label class="visually-hidden" for="query">Buscar por título o autor</label>
            <input type="search" id="query" name="query" value="{{ $query }}" placeholder="Título o autor…" autocomplete="off" class="form-control">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
    @if (count($ejemplares) > 0)
        <div class="book-grid">
            @foreach ($ejemplares as $ejemplar)
                <article class="book-card">
                    <div class="book-cover" aria-hidden="true"><div class="book-cover-inner">{{ $ejemplar->titulo }}</div></div>
                    <div class="book-card-body">
                        <h2>{{ $ejemplar->titulo }}</h2>
                        <p class="book-author">{{ $ejemplar->autores }}</p>
                        <div class="book-meta"><span>{{ $ejemplar->idioma }}</span><strong>S/ {{ number_format($ejemplar->precio, 2) }}</strong></div>
                        <p class="small mb-3">{{ $ejemplar->stock }} disponibles · Ejemplar {{ $ejemplar->numero_ejemplar }}</p>
                        <a href="{{ route('cliente.ejemplar', $ejemplar->id) }}" class="btn btn-outline-dark" aria-label="Ver detalle de {{ $ejemplar->titulo }}">Ver detalle</a>
                        @if (session('error') && session('error_for_detail') == $ejemplar->id)
                            <div class="alert alert-danger mt-3 mb-0" role="alert">{{ session('error') }}</div>
                        @endif
                        @if ($usuario->pedido_1_clic == true)
                            <form action="{{ route('cliente.pedido.clic') }}" method="post" class="d-flex align-items-end gap-2 mt-3 pt-3 section-rule">
                                @csrf
                                <input type="hidden" name="ejemplar_id" value="{{ $ejemplar->id }}">
                                <div><label for="cantidad-{{ $ejemplar->id }}" class="small">Cantidad</label><input id="cantidad-{{ $ejemplar->id }}" class="form-control" name="cantidad" type="number" value="1" min="1" style="max-width: 5rem" required></div>
                                <button type="submit" class="btn btn-primary">Añadir en 1 Clic</button>
                            </form>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <div class="empty-state" role="status"><h2>No encontramos ejemplares</h2><p>Prueba con otro título o apellido de autor.</p><a href="{{ route('cliente.home') }}" class="btn btn-outline-dark">Ver todo el catálogo</a></div>
    @endif
</div>
@endsection
