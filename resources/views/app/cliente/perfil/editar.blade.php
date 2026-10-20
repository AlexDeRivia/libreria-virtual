@extends('layouts.cliente')

@section('title', 'Editar perfil')

@section('content')

<div class="container page-shell">
    <div class="page-heading"><div><p class="eyebrow mb-2">Mi cuenta</p><h1>Editar perfil</h1><p>Actualiza los datos de tu cuenta de demostración.</p></div></div>

    <div class="row">

        <div class="col-lg-8 offset-lg-2">

            <div class="card">
                
                <form action="{{ route('cliente.perfil.update', $usuario) }}" method="post" class="needs-validation" novalidate>

                    @csrf
                    @method('put')

                    <div class="card-header">
                        Editar perfil
                    </div>

                    <div class="card-body">

                        <div class="row g-3">
                            <div class="col-lg-6">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $usuario->nombres }}" autocomplete="given-name" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $usuario->apellidos }}" autocomplete="family-name" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ $usuario->telefono }}" autocomplete="tel" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="rol_id" class="form-label">Tipo de cliente</label>
                                <select class="form-select" id="rol_id" name="rol_id" required>
                                    <option {{ ($usuario->rol_id == 2) ? 'selected' : '' }} value="2">Cliente ocasional</option>
                                    <option {{ ($usuario->rol_id == 3) ? 'selected' : '' }} value="3">Cliente Especializado</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="pedido_1_clic" class="form-label">Pedido 1 clic</label>
                                <input type="checkbox" class="btn-check" id="pedido_1_clic" name="pedido_1_clic" @if($usuario->pedido_1_clic) checked @endif onchange="toggleLabel()">
                                <label id="label_pedido_1_clic" class="btn btn-light w-100 border-secondary-subtle" for="pedido_1_clic"></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer text-end">
                        <a href="{{ route('cliente.perfil') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    window.onload = function() {
        toggleLabel();
    };
    function toggleLabel() {
        var checkbox = document.getElementById("pedido_1_clic");
        var label = document.getElementById("label_pedido_1_clic");
        
        if (checkbox.checked) {
            label.textContent = "Activado";
        } else {
            label.textContent = "Desactivado";
        }
    }
</script>

@endsection
