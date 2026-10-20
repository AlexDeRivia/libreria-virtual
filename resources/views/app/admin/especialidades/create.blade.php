@extends('layouts.admin')

@section('title', 'Especialidades')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.especialidades') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('admin.especialidades.store') }}" method="post" class="needs-validation" autocomplete="off" novalidate>

                @csrf

                <div class="card my-3">
                    <div class="card-header">Registrar nueva especialidad</div>
                    @error('especialidad')
                    <div class="card-header">
                        <div class="alert alert-danger mb-0" role="alert">{{ $message }}</div>
                    </div>
                    @enderror
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="especialidad" class="form-label">Especialidad</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <input value="{{ old('especialidad') }}" type="text" class="form-control" id="especialidad" name="especialidad" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.especialidades') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-primary">Insertar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection