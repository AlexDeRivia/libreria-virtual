@extends('layouts.admin')

@section('title', 'Ejemplares')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="me-auto btn btn-primary" href="{{ route('admin.ejemplares.create') }}">
            <i aria-hidden="true" class="fa-solid fa-file me-2"></i> Nuevo registro
        </a>
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.home') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">
    <div class="card my-3">
        <div class="card-header">Lista de Ejemplares</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="mitabla">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>ID</th>
                        <th>Libro</th>
                        <th>Idioma</th>
                        <th>Numero Ejemplar</th>
                        <th>Precio</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>ID</th>
                        <th>Libro</th>
                        <th>Idioma</th>
                        <th>Numero Ejemplar</th>
                        <th>Precio</th>
                        <th>Stock</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($ejemplares as $ejemplar)
                    <tr>
                        <td><a href="{{ route('admin.ejemplares.edit', $ejemplar) }}" class="link-primary"><i aria-hidden="true" class="fa-solid fa-pen me-2"></i>Editar</a></td>
                        <td><a href="{{ route('admin.ejemplares.show', $ejemplar) }}" class="link-danger"><i aria-hidden="true" class="fa-solid fa-trash me-2"></i>Eliminar</a></td>
                        <td>{{ $ejemplar->id }}</td>
                        <td>{{ $ejemplar->libro->titulo }}</td>
                        <td>{{ $ejemplar->idioma->idioma }}</td>
                        <td>{{ $ejemplar->numero_ejemplar }}</td>
                        <td>{{ $ejemplar->precio }}</td>
                        <td>{{ $ejemplar->stock }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="{{ asset('dist/js/datatables.js') }}"></script>
<script src="{{ asset('dist/js/mitable.js') }}"></script>

@endsection