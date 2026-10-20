@extends('layouts.admin')

@section('title', 'Preferencia Envio')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="me-auto btn btn-primary" href="{{ route('admin.preferenciasEnvio.create') }}">
            <i aria-hidden="true" class="fa-solid fa-file me-2"></i> Nuevo registro
        </a>
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.home') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">
    <div class="card my-3">
        <div class="card-header">Lista de Preferencias de Envio</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="mitabla">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>ID</th>
                        <th>Preferencia de Envio</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>ID</th>
                        <th>Preferencia de Envio</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($preferencia_envios as $preferencia_envio)
                    <tr>
                        <td><a href="{{ route('admin.preferenciasEnvio.edit', $preferencia_envio) }}" class="link-primary"><i aria-hidden="true" class="fa-solid fa-pen me-2"></i>Editar</a></td>
                        <td><a href="{{ route('admin.preferenciasEnvio.show', $preferencia_envio) }}" class="link-danger"><i aria-hidden="true" class="fa-solid fa-trash me-2"></i>Eliminar</a></td>
                        <td>{{ $preferencia_envio->id }}</td>
                        <td>{{ $preferencia_envio->preferencia }}</td>
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