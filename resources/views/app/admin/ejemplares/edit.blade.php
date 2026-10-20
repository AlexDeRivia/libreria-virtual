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

            <form action="{{ route('admin.ejemplares.update', $ejemplar) }}" method="post" class="needs-validation" autocomplete="off" novalidate>

                @csrf
                @method('put')

                <div class="card my-3">
                    <div class="card-header">Editar ejemplar</div>
                    @error('numero_ejemplar')
                    <div class="card-header">
                        <div class="alert alert-danger mb-0" role="alert">{{ $message }}</div>
                    </div>
                    @enderror
                    @error('precio')
                    <div class="card-header">
                        <div class="alert alert-danger mb-0" role="alert">{{ $message }}</div>
                    </div>
                    @enderror
                    @error('stock')
                    <div class="card-header">
                        <div class="alert alert-danger mb-0" role="alert">{{ $message }}</div>
                    </div>
                    @enderror
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="libro_id" class="form-label">Libro</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <select class="form-select @error('libro_id') is-invalid @enderror" id="libro_id" name="libro_id" required>
                                    <option value="" {{ old('libro_id', $ejemplar->libro_id) == '' ? 'selected' : '' }}></option>
                                    @foreach ($libros as $libro)
                                        <option value="{{ $libro->id }}" {{ old('libro_id', $ejemplar->libro_id) == $libro->id ? 'selected' : '' }}>
                                            {{ $libro->titulo }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-4">
                                <label for="idioma_id" class="form-label">Idioma</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <select class="form-select @error('idioma_id') is-invalid @enderror" id="idioma_id" name="idioma_id" required>
                                    <option value="" {{ old('idioma_id', $ejemplar->idioma_id) == '' ? 'selected' : '' }}></option>
                                    @foreach ($idiomas as $idioma)
                                        <option value="{{ $idioma->id }}" {{ old('idioma_id', $ejemplar->idioma_id) == $idioma->id ? 'selected' : '' }}>
                                            {{ $idioma->idioma }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>

                            <div class="col-lg-4">
                                <label for="numero_ejemplar" class="form-label">Numero de ejemplar</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <input value="{{ old('numero_ejemplar', $ejemplar->numero_ejemplar) }}" type="text" class="form-control" id="numero_ejemplar" name="numero_ejemplar" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-4">
                                <label for="precio" class="form-label">Precio</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <input value="{{ old('precio', $ejemplar->precio) }}" type="number" inputmode="decimal" step="0.01" min="0" class="form-control" id="precio" name="precio" required>
                                <div class="invalid-feedback">Este campo requiere un numero valido</div>
                            </div>
                            <div class="col-lg-4">
                                <label for="stock" class="form-label">Stock</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <input value="{{ old('stock', $ejemplar->stock) }}" type="number" class="form-control" id="stock" name="stock" min = "0" required>
                                <div class="invalid-feedback">Este campo requiere un numero valido</div>
                            </div>        
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.ejemplares') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
