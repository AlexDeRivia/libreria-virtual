@extends('layouts.home')
@section('title', 'Librería Virtual · Demo interactiva')
@section('content')
<section class="hero" aria-labelledby="hero-title">
    <div class="container hero-inner">
        <div class="hero-copy">
            <p class="eyebrow mb-3">Libros, pedidos y entregas en un solo lugar</p>
            <h1 id="hero-title" class="display-title mb-4">Tu próxima lectura empieza aquí.</h1>
            <p class="lead">Recorre el catálogo, elige ejemplares y descubre cómo se gestiona un pedido hasta su entrega.</p>
            <div class="hero-actions">
                <a class="btn btn-primary btn-lg" href="{{ route('catalogo.index') }}">Explorar catálogo</a>
                <a class="btn btn-outline-dark btn-lg" href="{{ config('demo.public_access') ? '#explorar-demo' : route('nosotros') }}">{{ config('demo.public_access') ? 'Elegir un rol' : 'Conocer la demo' }}</a>
            </div>
            <p class="hero-note">Una experiencia de demostración: pagos y envíos simulados.</p>
        </div>
        <div class="hero-shelf" aria-hidden="true">
            <span class="book-spine">Descubre</span><span class="book-spine">Elige</span><span class="book-spine">Reserva</span><span class="book-spine">Sigue</span><span class="book-spine">Disfruta</span>
        </div>
    </div>
</section>
<section class="container page-shell" aria-labelledby="recorrido-title">
    <div class="section-heading"><div><h2 id="recorrido-title">Un recorrido completo</h2><p>Explora la experiencia desde el primer libro hasta la entrega.</p></div></div>
    <div class="feature-strip">
        <div><strong>Encuentra un libro</strong><p>Busca por título o autor y revisa cada ejemplar disponible.</p></div>
        <div><strong>Arma tu pedido</strong><p>Agrega ejemplares al carrito y confirma una compra simulada.</p></div>
        <div><strong>Sigue el envío</strong><p>Consulta el estado de preparación, tránsito y entrega.</p></div>
    </div>
    <div class="section-heading mt-5 pt-3"><div><h2>Explora a tu ritmo</h2><p>El catálogo está abierto. {{ config('demo.public_access') ? 'Elige un rol para probar el flujo completo.' : 'Para probar un pedido, crea una cuenta con datos ficticios.' }}</p></div><a class="btn btn-outline-dark" href="{{ route('catalogo.index') }}">Ver todos los libros</a></div>
    @if (config('demo.public_access'))
        <div id="explorar-demo" class="demo-access-anchor">@include('partials.shared.demo-roles')</div>
    @endif
</section>
@endsection
