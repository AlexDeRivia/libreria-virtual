@extends('layouts.home')
@section('title', 'Acerca de la demo · Librería Virtual')
@section('content')
<div class="container page-shell">
    <div class="page-heading"><div><p class="eyebrow mb-2">Acerca del proyecto</p><h1>Una librería para recorrer de principio a fin.</h1><p>Esta aplicación muestra cómo se administran libros, ejemplares, pedidos y entregas en un mismo flujo.</p></div></div>
    <div class="feature-strip mb-5">
        <div><strong>1. Catálogo</strong><p>Consulta títulos, autores, idiomas y disponibilidad sin crear una cuenta.</p></div>
        <div><strong>2. Pedido</strong><p>{{ config('demo.public_access') ? 'Entra como cliente, elige ejemplares y confirma una compra de prueba.' : 'Registra un cliente ficticio, elige ejemplares y confirma una compra de prueba.' }}</p></div>
        <div><strong>3. Seguimiento</strong><p>Revisa el avance del envío simulado desde tu historial.</p></div>
    </div>
    <div class="action-panel d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <div><h2 class="h4 mb-1">Prueba la experiencia</h2><p class="mb-0">No se procesan pagos ni se entregan paquetes reales.</p></div>
        <a class="btn btn-primary" href="{{ config('demo.public_access') ? route('login') : route('catalogo.index') }}">{{ config('demo.public_access') ? 'Elegir un rol' : 'Explorar catálogo' }}</a>
    </div>
</div>
@endsection
