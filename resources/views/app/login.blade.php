@extends('layouts.home')
@section('title', 'Ingresar · Librería Virtual')
@section('content')
<div class="container auth-shell">
    <div class="page-heading"><div><p class="eyebrow mb-2">Tu cuenta</p><h1>Ingresa a tu biblioteca</h1><p>Continúa tu pedido o revisa el seguimiento de tus compras simuladas.</p></div></div>
    <div class="card">
        <div class="card-body">
            @if ($errors->has('correo'))<div class="alert alert-danger" role="alert" aria-live="polite">{{ $errors->first('correo') }}</div>@endif
            <form action="{{ route('login.auth') }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3"><label for="email" class="form-label">Correo electrónico</label><input value="{{ old('email') }}" type="email" class="form-control" id="email" name="email" autocomplete="username" spellcheck="false" required><div class="invalid-feedback">Ingresa un correo electrónico válido.</div></div>
                <div class="mb-3"><label for="contrasena" class="form-label">Contraseña</label><div class="input-group"><input type="password" class="form-control" id="contrasena" name="password" autocomplete="current-password" required><button class="btn btn-outline-dark" type="button" id="togglePassword" aria-controls="contrasena" aria-pressed="false">Mostrar</button><div class="invalid-feedback">Ingresa tu contraseña.</div></div></div>
                <div class="form-check mb-4"><input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><label class="form-check-label" for="remember">Recordar mi inicio de sesión</label></div>
                <div class="d-flex flex-wrap gap-2 justify-content-end"><button type="reset" class="btn btn-secondary">Limpiar</button><button type="submit" class="btn btn-primary" {{ session('disabled') ? 'disabled' : '' }}>Ingresar</button></div>
            </form>
        </div>
        <div class="card-footer text-center">¿Aún no tienes cuenta? <a href="{{ route('register') }}">Crea una cuenta de demostración</a></div>
    </div>
</div>
<script>
document.getElementById('togglePassword')?.addEventListener('click', function () {
    const input = document.getElementById('contrasena');
    const showing = input.type === 'password';
    input.type = showing ? 'text' : 'password';
    this.textContent = showing ? 'Ocultar' : 'Mostrar';
    this.setAttribute('aria-pressed', showing ? 'true' : 'false');
});
</script>
@endsection
