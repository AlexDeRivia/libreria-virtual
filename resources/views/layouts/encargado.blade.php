<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#123e45">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('dist/css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/redesign.css') }}">
</head>

<body class="@yield('back')">

<a class="skip-link" href="#contenido">Saltar al contenido</a>
@include('partials.encargado.navbar')

<main id="contenido">@if (config('demo.public_access'))<div class="container">@include('partials.shared.demo-roles', ['compact' => true])</div>@endif @yield('content')</main>

@include('partials.encargado.footer')

</body>

<script src="{{ asset('dist/fonts/all.js') }}"></script>
<script src="{{ asset('dist/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('dist/js/scripts.js') }}"></script>
<script src="{{ asset('dist/js/validation.js') }}"></script>
<script src="{{ asset('dist/js/redesign.js') }}"></script>

</html>
