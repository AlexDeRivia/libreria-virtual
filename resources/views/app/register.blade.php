@extends('layouts.home')

@section('title', 'Registrarse')

@section('back', 'bg-body-tertiary')

@section('content')

<div class="container auth-shell">
    <div class="page-heading"><div><p class="eyebrow mb-2">Demo interactiva</p><h1>Crea una cuenta de prueba</h1><p>Usa datos ficticios para preparar un pedido y seguir su entrega simulada.</p></div></div>

    <div class="row">

        <div class="col-12">

            <div class="card shadow-sm">

                <div class="card-header bg-dark">Datos de la cuenta</div>

                @if ($errors->any())
                    <div class="alert alert-danger m-3 mb-0" id="validationSummary" role="alert" tabindex="-1">
                        <strong>Revisa estos datos para crear la cuenta:</strong>
                        <ul class="mb-0 mt-2">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form method="post" action="{{ route('register.store') }}" id="clearForm" class="needs-validation" novalidate>
                    
                    @csrf

                    <div class="card-body">

                        <div class="alert alert-info">Esta es una demostración. Usa datos ficticios; no ingreses información personal real.</div>

                        <h2 class="h5">Datos de registro</h2>
                        <hr>

                        <div class="row text-start text-lg-end align-items-start">

                            <div class="col-lg-2">
                                <label for="email">Correo:</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="email" class="form-control custom-validation" id="email" name="email" value="{{ old('email') }}" autocomplete="username" spellcheck="false" required>
                                <div class="invalid-feedback">Ingresa un correo electrónico válido.</div>
                                @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-lg-6"></div>

                            <div class="col-lg-2">
                                <label for="password">Contraseña:</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="password" class="form-control custom-validation" id="password" name="password" autocomplete="new-password" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                                @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-lg-2">
                                <label for="password_2">Confirmar:</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="password" class="form-control custom-validation" id="password_2" name="password_2" autocomplete="new-password" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                                @error('password_2')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <h2 class="h5">Datos personales</h2>
                        <hr>

                        <div class="row text-start text-lg-end align-items-start">

                            <div class="col-lg-2">
                                <label for="nombres">Nombres:</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" class="form-control custom-validation" id="nombres" name="nombres" minlength="3" value="{{ old('nombres') }}" autocomplete="given-name" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                                @error('nombres')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-lg-2">
                                <label for="apellidos">Apellidos:</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" class="form-control custom-validation" id="apellidos" name="apellidos" minlength="3" value="{{ old('apellidos') }}" autocomplete="family-name" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                                @error('apellidos')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-lg-2">
                                <label for="telefono">Teléfono:</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="tel" class="form-control custom-validation" id="telefono" name="telefono" minlength="3" maxlength="11" value="{{ old('telefono') }}" autocomplete="tel" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                                @error('telefono')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <h2 class="h5">Datos de preferencia</h2>
                        <hr>

                        <div class="row text-start text-lg-end align-items-start">

                            <div class="col-lg-2">
                                <label for="pais_id">País:</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <select class="form-select" id="pais_id" name="pais_id" autocomplete="country-name" required>
                                    <option value=""></option>
                                    @foreach($paises as $pais)
                                        <option value="{{ $pais->id }}" {{ old('pais_id') == $pais->id ? 'selected' : '' }}>
                                            {{ $pais->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pais_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-lg-2">
                                <label for="provincia_id">Provincia:</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <select class="form-select" id="provincia_id" name="provincia_id" autocomplete="address-level1" disabled required>
                                    <option value=""></option>
                                </select>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                                @error('provincia_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-lg-2">
                                <label for="localidad">Localidad:</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" class="form-control custom-validation" id="localidad" name="localidad" value="{{ old('localidad') }}" autocomplete="address-level2" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                                @error('localidad')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-lg-2">
                                <label for="direccion">Dirección:</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" class="form-control custom-validation" id="direccion" name="direccion" value="{{ old('direccion') }}" autocomplete="street-address" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                                @error('direccion')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-lg-2">
                                <label for="codigo_postal">Código postal:</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <input type="text" class="form-control custom-validation" id="codigo_postal" name="codigo_postal" minlength="3" maxlength="20" value="{{ old('codigo_postal') }}" autocomplete="postal-code" required>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                                @error('codigo_postal')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-lg-2">
                                <label for="pedido_1_clic">Pedido 1 clic:</label>
                            </div>
                            <div class="col-lg-4 mb-3 text-start">
                                <input type="checkbox" class="btn-check" id="pedido_1_clic" name="pedido_1_clic" @if(old('pedido_1_clic')) checked @endif onchange="toggleLabel()">
                                <label id="label_pedido_1_clic" class="btn btn-light w-100 border-secondary-subtle" for="pedido_1_clic">Desactivado</label>
                            </div>

                            <div class="col-lg-2">
                                <label for="rol_id">Tipo de cliente:</label>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <select class="form-select" id="rol_id" name="rol_id" autocomplete="off" required>
                                    <option value=""></option>
                                    <option value="2" {{ old('rol_id') == '2' ? 'selected' : '' }}>Cliente ocasional</option>
                                    <option value="3" {{ old('rol_id') == '3' ? 'selected' : '' }}>Cliente especializado</option>
                                </select>
                                <div class="invalid-feedback">Este campo es obligatorio</div>
                                @error('rol_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white" id="especialidadesDiv" style="display: none;">
                        <div class="form-group py-2">
                            <h2 class="h5">Elige al menos una especialidad</h2>
                            <hr>
                            <div class="row" id="especialidadesCheckboxes"></div>
                            <p id="especialidadesError" class="text-danger small mt-2 mb-0 d-none" role="alert">Selecciona al menos una especialidad.</p>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <div class="my-1">
                            <a class="btn btn-secondary" href="{{ route('home') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary ms-2">Crear cuenta de prueba</button>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <span>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Ingresa aquí</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('dist/js/jquery.js') }}"></script>

<script>
    $(document).ready(function () {
        const provinciaAnterior = @json(old('provincia_id'));
        $('#pais_id').change(function () {
            var paisId = $(this).val();
            if (paisId) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('cargar.provincias') }}",
                    data: {pais_id: paisId},
                    dataType: 'json',
                    success: function (provincias) {
                        $('#provincia_id').empty().prop('disabled', false);
                        $('#provincia_id').append($('<option>', {value: '', text: 'Selecciona una provincia'}));
                        $.each(provincias, function (key, provincia) {
                            $('#provincia_id').append($('<option>', {value: provincia.id, text: provincia.nombre}));
                        });
                        if (provinciaAnterior) $('#provincia_id').val(String(provinciaAnterior));
                    }
                });
            } else {
                $('#provincia_id').empty().prop('disabled', true);
            }
        });
        if ($('#pais_id').val()) $('#pais_id').trigger('change');
    });
</script>

<script>
    $(document).ready(function () {
        const especialidadesAnteriores = @json(old('especialidades', []));
        $('#rol_id').change(function () {
            var rolId = $(this).val();
            if (rolId && rolId === '3') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('cargar.especialidades') }}",
                    dataType: 'json',
                    success: function (especialidades) {
                        $('#especialidadesCheckboxes').empty();
                        $.each(especialidades, function (key, especialidad) {
                            const id = 'especialidad-' + especialidad.id;
                            const input = $('<input>', {class: 'form-check-input', type: 'checkbox', id, name: 'especialidades[]', value: especialidad.id});
                            input.prop('checked', especialidadesAnteriores.map(String).includes(String(especialidad.id)));
                            const label = $('<label>', {class: 'form-check-label', for: id, text: especialidad.especialidad});
                            $('#especialidadesCheckboxes').append($('<div>', {class: 'col-sm-6 mb-2'}).append($('<div>', {class: 'form-check'}).append(input, label)));
                        });
                        $('#especialidadesDiv').show();
                    }
                });
            } else {
                $('#especialidadesCheckboxes').empty();
                $('#especialidadesDiv').hide();
            }
        });

        $('#clearForm').submit(function (event) {
            if ($('#rol_id').val() === '3') {
                var checkboxes = $('input[name="especialidades[]"]:checked');
                if (checkboxes.length === 0) {
                    $('#especialidadesError').removeClass('d-none');
                    event.preventDefault();
                    $('#especialidadesCheckboxes input').first().trigger('focus');
                } else {
                    $('#especialidadesError').addClass('d-none');
                }
            }
        });
        if ($('#rol_id').val() === '3') $('#rol_id').trigger('change');
        toggleLabel();
    });
</script>

<script>
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
