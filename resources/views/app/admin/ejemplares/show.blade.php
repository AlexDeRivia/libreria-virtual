@extends('layouts.admin')

@section('title', 'Ejemplares')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.ejemplares') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('admin.ejemplares.destroy', $ejemplar) }}" method="post">

                @csrf
                @method('delete')

                <div class="card my-3">
                    <div class="card-header">Eliminar Ejemplares</div>
                    @if ($errors->has('ejemplar'))
                        <div class="alert alert-warning m-3">{{ $errors->first('ejemplar') }}</div>
                    @endif
                    <div class="card-body">
                        <p>El siguiente ejemplar será eliminado definitivamente:</p>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Libro</th>
                                    <th scope="col">Numero Ejemplar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $ejemplar->libro->titulo }}</td>
                                    <td>{{ $ejemplar->numero_ejemplar }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.ejemplares') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
