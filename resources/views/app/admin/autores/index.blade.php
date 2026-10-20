@extends('layouts.admin')

@section('title', 'Autores')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="me-auto btn btn-primary" href="{{ route('admin.autores.create') }}">
            <i aria-hidden="true" class="fa-solid fa-file me-2"></i> Nuevo registro
        </a>
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.home') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">
    <div class="card my-3">
        <div class="card-header">Lista de Autores</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="mitabla">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Nacionalidad</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Nacionalidad</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($autores as $autor)
                    <tr>
                        <td><a href="{{ route('admin.autores.edit', $autor) }}" class="link-primary"><i aria-hidden="true" class="fa-solid fa-pen me-2"></i>Editar</a></td>
                        <td><a href="{{ route('admin.autores.show', $autor) }}" class="link-danger"><i aria-hidden="true" class="fa-solid fa-trash me-2"></i>Eliminar</a></td>
                        <td>{{ $autor->id }}</td>
                        <td>{{ $autor->nombres }}</td>
                        <td>{{ $autor->apellidos }}</td>
                        <td>{{ $autor->nacionalidad->nacionalidad }}</td>
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