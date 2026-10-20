@extends('layouts.cliente')
@section('title', 'Mi perfil · Librería Virtual')
@section('content')
<div class="container page-shell">
    <div class="page-heading"><div><p class="eyebrow mb-2">Mi cuenta</p><h1>Mi perfil</h1><p>Revisa los datos ficticios asociados a tu cuenta de demostración.</p></div><a href="{{ route('cliente.perfil.edit') }}" class="btn btn-primary">Editar perfil</a></div>
    <div class="profile-grid">
        <section class="card" aria-labelledby="personal-title"><div class="card-header" id="personal-title">Datos personales</div><div class="card-body"><dl class="profile-list"><div><dt>Nombre</dt><dd>{{ $usuario->nombres }} {{ $usuario->apellidos }}</dd></div><div><dt>Correo</dt><dd>{{ $usuario->email }}</dd></div><div><dt>Teléfono</dt><dd>{{ $usuario->telefono }}</dd></div><div><dt>Tipo de cliente</dt><dd>{{ $usuario->rol }}</dd></div><div><dt>Pedido en 1 clic</dt><dd>{{ $usuario->pedido_1_clic ? 'Activado' : 'Desactivado' }}</dd></div></dl></div></section>
        <section class="card" aria-labelledby="address-title"><div class="card-header" id="address-title">Dirección de demostración</div><div class="card-body"><dl class="profile-list"><div><dt>País</dt><dd>{{ $usuario->pais }}</dd></div><div><dt>Provincia</dt><dd>{{ $usuario->provincia }}</dd></div><div><dt>Localidad</dt><dd>{{ $usuario->localidad }}</dd></div><div><dt>Dirección</dt><dd>{{ $usuario->direccion }}</dd></div><div><dt>Código postal</dt><dd>{{ $usuario->codigo_postal }}</dd></div></dl></div></section>
    </div>
    @if ($usuario->rol == 'Cliente Especializado')
        <section class="card mt-4" aria-labelledby="specialties-title"><div class="card-header" id="specialties-title">Especialidades</div><div class="card-body">@if (count($especialidades) > 0)<ul class="mb-0">@foreach ($especialidades as $e)<li>{{ $e }}</li>@endforeach</ul>@else<p class="mb-0">Aún no tienes especialidades seleccionadas.</p>@endif</div><div class="card-footer"><a href="{{ route('cliente.perfil.especialidades') }}" class="btn btn-outline-dark">Modificar especialidades</a></div></section>
    @endif
</div>
@endsection
