@extends('layouts.admin')

@section('title', 'Provincias')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.provincias') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('admin.provincias.update', $provincia) }}" method="post" class="needs-validation" autocomplete="off" novalidate>

                @csrf
                @method('put')

                <div class="card my-3">
                    <div class="card-header">Editar provincia</div>
                    @error('nombre')
                    <div class="card-header">
                        <div class="alert alert-danger mb-0" role="alert">{{ $message }}</div>
                    </div>
                    @enderror
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="nombre" class="form-label">Nombre</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <input value="{{ old('nombre', $provincia->nombre) }}" type="text" class="form-control" id="nombre" name="nombre" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-4">
                                <label for="pais_id" class="form-label">Pais</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <select class="form-select @error('pais_id') is-invalid @enderror" id="pais_id" name="pais_id" required>
                                    <option value="" {{ old('pais_id', $provincia->pais_id) == '' ? 'selected' : '' }}></option>
                                    @foreach ($paises as $pais)
                                        <option value="{{ $pais->id }}" {{ old('pais_id', $provincia->pais_id) == $pais->id ? 'selected' : '' }}>
                                            {{ $pais->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.provincias') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection