@extends('layouts.admin')

@section('title', 'Autores')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.autores') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('admin.autores.update', $autor) }}" method="post" class="needs-validation" autocomplete="off" novalidate>

                @csrf
                @method('put')

                <div class="card my-3">
                    <div class="card-header">Editar autor</div>
                    @error('nombres')
                    <div class="card-header">
                        <div class="alert alert-danger mb-0" role="alert">{{ $message }}</div>
                    </div>
                    @enderror
                    @error('apellidos')
                    <div class="card-header">
                        <div class="alert alert-danger mb-0" role="alert">{{ $message }}</div>
                    </div>
                    @enderror
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="nombres" class="form-label">Nombres</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <input value="{{ old('nombres', $autor->nombres) }}" type="text" class="form-control" id="nombres" name="nombres" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-4">
                                <label for="apellidos" class="form-label">Apellidos</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <input value="{{ old('apellidos', $autor->apellidos) }}" type="text" class="form-control" id="apellidos" name="apellidos" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            
                            <div class="col-lg-4">
                                <label for="nacionalidad_id" class="form-label">Nacionalidad</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <select class="form-select @error('nacionalidad_id') is-invalid @enderror" id="nacionalidad_id" name="nacionalidad_id" required>
                                    <option value="" {{ old('nacionalidad_id', $autor->nacionalidad_id) == '' ? 'selected' : '' }}></option>
                                    @foreach ($nacionalidades as $nacionalidad)
                                        <option value="{{ $nacionalidad->id }}" {{ old('nacionalidad_id', $autor->nacionalidad_id) == $nacionalidad->id ? 'selected' : '' }}>
                                            {{ $nacionalidad->nacionalidad }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.autores') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection