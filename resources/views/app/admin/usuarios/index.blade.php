@extends('layouts.admin')

@section('title', 'Usuarios')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <span class="navbar-brand">Registro de usuarios</span>
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.home') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">
    <div class="card my-3">
        <div class="card-header">Lista de Usuarios</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="mitabla3">
                <thead>
                    <tr>
                        <th>Correo</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Telefono</th>
                        <th>Rol</th>
                        <th>Pais</th>
                        <th>Provincia</th>
                        <th>Localidad</th>
                        <th>Direccion</th>
                        <th>Codigo Postal</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Correo</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Telefono</th>
                        <th>Rol</th>
                        <th>Pais</th>
                        <th>Provincia</th>
                        <th>Localidad</th>
                        <th>Direccion</th>
                        <th>Codigo Postal</th>


                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->apellidos }}</td>
                        <td>{{ $usuario->nombres }}</td>
                        <td>{{ $usuario->telefono }}</td>
                        <td>{{ $usuario->rol->rol }}</td>
                        <td>{{ $usuario->pais->nombre }}</td>
                        <td>{{ $usuario->provincia->nombre }}</td>
                        <td>{{ $usuario->localidad }}</td>
                        <td>{{ $usuario->direccion }}</td>
                        <td>{{ $usuario->codigo_postal }}</td>

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
