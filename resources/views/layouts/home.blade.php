<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#123e45">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('dist/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/bootstrap/icons/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/redesign.css') }}">
</head>

<body class="@yield('back')">

<a class="skip-link" href="#contenido">Saltar al contenido</a>
@include('partials.app.navbar')

<main id="contenido">@yield('content')</main>

@include('partials.app.footer')

</body>

<script src="{{ asset('dist/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('dist/js/validation.js') }}"></script>
<script src="{{ asset('dist/js/redesign.js') }}"></script>

</html>
