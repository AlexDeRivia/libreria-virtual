@extends('layouts.admin')

@section('title', 'Preferencia Envio')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.preferenciasEnvio') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('admin.preferenciasEnvio.destroy', $preferencia_envio) }}" method="post">

                @csrf
                @method('delete')

                <div class="card my-3">
                    <div class="card-header">Eliminar Preferencia de envio</div>
                    <div class="card-body">
                        <p>La siguiente preferencia de envio será eliminada definitivamente:</p>
                        <input type="hidden" name="id" value="6">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Preferencia de envio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $preferencia_envio->preferencia }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.preferenciasEnvio') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection