@extends('layouts.admin')

@section('title', 'Editar libro')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.libros') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="row">

        <div class="col-lg-6 offset-lg-3">

            <form action="{{ route('admin.libros.update', $libro) }}" method="post" class="needs-validation" autocomplete="off" novalidate>

                @csrf
                @method('put')

                <div class="card my-3">
                    <div class="card-header">Editar libro</div>
                    @error('isbn')
                    <div class="card-header">
                        <div class="alert alert-danger mb-0" role="alert">{{ $message }}</div>
                    </div>
                    @enderror
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="isbn" class="form-label">ISBN</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <input value="{{ old('isbn', $libro->isbn) }}" type="text" class="form-control" id="isbn" name="isbn" required minlength="10" maxlength="20">
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-4">
                                <label for="titulo" class="form-label">Título</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <input value="{{ old('titulo', $libro->titulo) }}" type="text" class="form-control" id="titulo" name="titulo" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-4">
                                <label for="resumen" class="form-label">Resumen</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <textarea class="form-control" name="resumen" id="resumen" rows="3" required>{{ old('resumen', $libro->resumen) }}</textarea>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                            </div>
                            <div class="col-lg-4">
                                <label for="es_novedad" class="form-label">Es novedad</label>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <input type="checkbox" class="btn-check" id="es_novedad" name="es_novedad" @if($libro->es_novedad) checked @endif onchange="toggleLabel()">
                                <label id="label_es_novedad" class="btn btn-light w-100 border-secondary-subtle" for="es_novedad">NO</label>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">Autores</div>
                            <div class="card-body">
                                <table class="table table-striped table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Autor</th>
                                            <th>Es principal</th>
                                            <th>Nombres</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($autores as $autor)
                                            <tr>
                                                <td class="py-0">
                                                    <input class="form-check-input autor-checkbox" type="checkbox" name="autor_id[]" value="{{ $autor->id }}" id="autor_{{ $autor->id }}" aria-label="Seleccionar autor {{ $autor->nombres }} {{ $autor->apellidos }}" onchange="checkboxChanged()" {{ in_array($autor->id, old('autor_id', $libro->autores->pluck('id')->all())) ? 'checked' : '' }}>
                                                </td>
                                                <td class="py-0">
                                                    <input class="form-check-input es-principal-checkbox" type="checkbox" name="es_principal[]" value="{{ $autor->id }}" id="es_principal_{{ $autor->id }}" aria-label="Marcar {{ $autor->nombres }} {{ $autor->apellidos }} como autor principal" disabled {{ in_array($autor->id, old('es_principal', $libro->autores->filter(fn ($a) => $a->pivot->es_principal)->pluck('id')->all())) ? 'checked' : '' }}>
                                                </td>
                                                <td class="py-0">{{ $autor->nombres . ' ' . $autor->apellidos }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">Especialidades</div>
                            <div class="card-body">
                                <table class="table table-striped table-hover mb-0">
                                    <thead>
                                        <tr>
                                        <th>Seleccionar</th>
                                            <th>Especialidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($especialidades as $especialidad)
                                            <tr>
                                                <td class="py-0">
                                                    <input class="form-check-input" type="checkbox" name="especialidad_id[]" value="{{ $especialidad->id }}" aria-label="Seleccionar especialidad {{ $especialidad->especialidad }}" {{ in_array($especialidad->id, old('especialidad_id', $libro->especialidades->pluck('id')->all())) ? 'checked' : '' }}>
                                                </td>
                                                <td class="py-0">{{ $especialidad->especialidad }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.libros') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="ms-auto btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        checkboxChanged();
    });
    function checkboxChanged() {
        var checkboxes = document.querySelectorAll('.autor-checkbox');
        checkboxes.forEach(function(checkbox) {
            var autorId = checkbox.value;
            var esPrincipalCheckbox = document.getElementById('es_principal_' + autorId);
            if (checkbox.checked) {
                esPrincipalCheckbox.disabled = false;
            } else {
                esPrincipalCheckbox.checked = false;
                esPrincipalCheckbox.disabled = true;
            }
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        toggleLabel();
    });
    function toggleLabel() {
        var checkbox = document.getElementById("es_novedad");
        var label = document.getElementById("label_es_novedad");
        
        if (checkbox.checked) {
            label.textContent = "SI";
        } else {
            label.textContent = "NO";
        }
    }
</script>

@endsection
