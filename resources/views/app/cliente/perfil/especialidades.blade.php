@extends('layouts.cliente')

@section('title', 'Especialidades')

@section('content')

<div class="container page-shell">
    <div class="page-heading"><div><p class="eyebrow mb-2">Mi cuenta</p><h1>Mis especialidades</h1><p>Elige las áreas de lectura que te interesan.</p></div></div>

    <div class="row">

        <div class="col-lg-8 offset-lg-2">

            <div class="card">
                
                <form action="{{ route('cliente.perfil.especialidades.update') }}" method="post">

                    @csrf

                    <div class="card-header">
                        Modificar Especialidades
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($especialidades as $especialidad)
                            <div class="col-sm-6 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="especialidades[]" type="checkbox" value="{{ $especialidad->id }}" id="especialidad-{{ $especialidad->id }}" {{ in_array($especialidad->id, array_column($usuario['especialidades']->toArray(), 'id')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="especialidad-{{ $especialidad->id }}">{{ $especialidad->especialidad }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="card-footer text-end">
                        <a href="{{ route('cliente.perfil') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar especialidades</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
