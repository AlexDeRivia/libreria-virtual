@extends('layouts.admin')

@section('title', 'Libros')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="me-auto btn btn-primary" href="{{ route('admin.libros.create') }}">
            <i aria-hidden="true" class="fa-solid fa-file me-2"></i> Nuevo registro
        </a>
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.home') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">
    <div class="card my-3">
        <div class="card-header">Lista de Libros</div>
        <div class="card-body">
            @if ($errors->has('libro'))
                <div class="alert alert-warning">{{ $errors->first('libro') }}</div>
            @endif
            <table class="table table-striped table-hover" id="mitabla">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>ID</th>
                        <th>ISBN</th>
                        <th>Título</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>ID</th>
                        <th>ISBN</th>
                        <th>Título</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($libros as $libro)
                        <tr>
                            <td><a href="{{ route('admin.libros.edit', $libro) }}" class="link-primary"><i aria-hidden="true" class="fas fa-pen me-2"></i>Editar</a></td>
                            <td>
                                <form action="{{ route('admin.libros.destroy', $libro) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-link link-danger p-0" type="submit"><i aria-hidden="true" class="fa-solid fa-trash me-2"></i>Eliminar</button>
                                </form>
                            </td>
                            <td>{{ $libro->id }}</td>
                            <td>{{ $libro->isbn }}</td>
                            <td><a href="{{ route('admin.libros.show', $libro) }}">{{ $libro->titulo }}</a></td>
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
