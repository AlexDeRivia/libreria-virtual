@extends('layouts.admin')
@section('title', 'Mi cuenta')
@section('content')
<div class="container py-4">
    <p class="lead mb-4">Datos de la cuenta administradora de demostración.</p>
    <div class="profile-grid">
        <section class="card" aria-labelledby="admin-personal"><div class="card-header" id="admin-personal">Datos personales</div><div class="card-body"><dl class="profile-list"><div><dt>Nombre</dt><dd>{{ $usuario->nombres }} {{ $usuario->apellidos }}</dd></div><div><dt>Correo</dt><dd>{{ $usuario->email }}</dd></div><div><dt>Teléfono</dt><dd>{{ $usuario->telefono }}</dd></div></dl></div></section>
        <section class="card" aria-labelledby="admin-address"><div class="card-header" id="admin-address">Ubicación</div><div class="card-body"><dl class="profile-list"><div><dt>País</dt><dd>{{ $usuario->pais->nombre }}</dd></div><div><dt>Provincia</dt><dd>{{ $usuario->provincia->nombre }}</dd></div><div><dt>Localidad</dt><dd>{{ $usuario->localidad }}</dd></div><div><dt>Dirección</dt><dd>{{ $usuario->direccion }}</dd></div><div><dt>Código postal</dt><dd>{{ $usuario->codigo_postal }}</dd></div></dl></div></section>
    </div>
</div>
@endsection
