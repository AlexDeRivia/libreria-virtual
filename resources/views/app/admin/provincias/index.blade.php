@extends('layouts.admin')

@section('title', 'Provincias')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="me-auto btn btn-primary" href="{{ route('admin.provincias.create') }}">
            <i aria-hidden="true" class="fa-solid fa-file me-2"></i> Nuevo registro
        </a>
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.home') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">
    <div class="card my-3">
        <div class="card-header">Lista de Provincias</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="mitabla">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Pais</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>ID</th>
                        <th>Pais</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($provincias as $provincia)
                    <tr>
                        <td><a href="{{ route('admin.provincias.edit', $provincia) }}" class="link-primary"><i aria-hidden="true" class="fa-solid fa-pen me-2"></i>Editar</a></td>
                        <td><a href="{{ route('admin.provincias.show', $provincia) }}" class="link-danger"><i aria-hidden="true" class="fa-solid fa-trash me-2"></i>Eliminar</a></td>
                        <td>{{ $provincia->id }}</td>
                        <td>{{ $provincia->nombre }}</td>
                        <td>{{ $provincia->pais->nombre }}</td>
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