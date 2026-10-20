@extends('layouts.admin')

@section('title', 'Nacionalidades')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.nacionalidades') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('admin.nacionalidades.destroy', $nacionalidad) }}" method="post">

                @csrf
                @method('delete')

                <div class="card my-3">
                    <div class="card-header">Eliminar Nacionalidades</div>
                    <div class="card-body">
                        <p>La siguiente nacionalidad será eliminada definitivamente:</p>
                        <input type="hidden" name="id" value="6">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nacionalidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $nacionalidad->nacionalidad }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.nacionalidades') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection