@extends('layouts.admin')
@section('title', 'Panel de administración')
@section('content')
<div class="container py-4">
    <p class="lead mb-4">Gestiona el catálogo y consulta los pedidos de esta demostración.</p>
    <div class="dashboard-grid mb-5">
        <a class="dashboard-stat" href="{{ route('admin.usuarios') }}"><span>Usuarios</span><strong>{{ $usuarios }}</strong><small>Ver usuarios</small></a>
        <a class="dashboard-stat" href="{{ route('admin.preferenciasEnvio') }}"><span>Preferencias de envío</span><strong>{{ $preferenciasEnvio }}</strong><small>Ver preferencias</small></a>
        <a class="dashboard-stat" href="{{ route('admin.nacionalidades') }}"><span>Nacionalidades</span><strong>{{ $nacionalidades }}</strong><small>Ver nacionalidades</small></a>
        <a class="dashboard-stat" href="{{ route('admin.paises') }}"><span>Países</span><strong>{{ $paises }}</strong><small>Ver países</small></a>
    </div>
    <div class="section-heading"><div><h2>Accesos principales</h2><p>Entra directamente a las tareas más frecuentes.</p></div></div>
    <div class="feature-strip">
        <div><strong>Pedidos</strong><p>Consulta compras y su seguimiento simulado.</p><a href="{{ route('admin.pedidos') }}" class="btn btn-outline-dark mt-3">Ver pedidos</a></div>
        <div><strong>Libros</strong><p>Edita los títulos y sus datos bibliográficos.</p><a href="{{ route('admin.libros') }}" class="btn btn-outline-dark mt-3">Gestionar libros</a></div>
        <div><strong>Ejemplares</strong><p>Revisa disponibilidad, precio e idioma.</p><a href="{{ route('admin.ejemplares') }}" class="btn btn-outline-dark mt-3">Gestionar ejemplares</a></div>
    </div>
</div>
@endsection
