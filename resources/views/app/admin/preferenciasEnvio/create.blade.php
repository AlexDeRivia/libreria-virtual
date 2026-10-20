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

            <form action="{{ route('admin.preferenciasEnvio.store') }}" method="post" class="needs-validation" autocomplete="off" novalidate>

                @csrf

                <div class="card my-3">
                    <div class="card-header">Registrar nueva preferencia de envio</div>
                    @error('preferencia')
                    <div class="card-header">
                        <div class="alert alert-danger mb-0" role="alert">{{ $message }}</div>
                    </div>
                    @enderror
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="preferencia" class="form-label">Preferencia de Envio</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <input value="{{ old('preferencia') }}" type="text" class="form-control" id="preferencia" name="preferencia" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.preferenciasEnvio') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-primary">Insertar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection