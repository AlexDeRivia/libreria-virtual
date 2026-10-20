@extends('layouts.admin')

@section('title', 'Libro')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>{{ $libro->titulo }}</span>
            <a href="{{ route('admin.libros') }}" class="btn btn-secondary">Volver</a>
        </div>
        <div class="card-body">
            <p><strong>ISBN:</strong> {{ $libro->isbn }}</p>
            <p>{{ $libro->resumen }}</p>
            <p><strong>Autores:</strong> {{ $libro->autores->map(fn ($autor) => $autor->nombres.' '.$autor->apellidos)->join(', ') }}</p>
            <p><strong>Especialidades:</strong> {{ $libro->especialidades->pluck('especialidad')->join(', ') }}</p>
            <p><strong>Ejemplares:</strong> {{ $libro->ejemplares->count() }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.libros.edit', $libro) }}" class="btn btn-primary">Editar</a>
        </div>
    </div>
</div>
@endsection
