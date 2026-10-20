@extends('layouts.admin')

@section('title', 'Paises')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="me-auto btn btn-primary" href="{{ route('admin.paises.create') }}">
            <i aria-hidden="true" class="fa-solid fa-file me-2"></i> Nuevo registro
        </a>
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.home') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">
    <div class="card my-3">
        <div class="card-header">Lista de Paises</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="mitabla">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>ID</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>ID</th>
                        <th>Nombre</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($paises as $pais)
                    <tr>
                        <td><a href="{{ route('admin.paises.edit', $pais) }}" class="link-primary"><i aria-hidden="true" class="fa-solid fa-pen me-2"></i>Editar</a></td>
                        <td><a href="{{ route('admin.paises.show', $pais) }}" class="link-danger"><i aria-hidden="true" class="fa-solid fa-trash me-2"></i>Eliminar</a></td>
                        <td>{{ $pais->id }}</td>
                        <td>{{ $pais->nombre }}</td>
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