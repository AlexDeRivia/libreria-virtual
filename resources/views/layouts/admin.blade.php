@php
    $email = auth('usuarios')->user()->email;
@endphp

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

<body class="sb-nav-fixed">

<a class="skip-link" href="#contenido">Saltar al contenido</a>
@component('partials.admin.navbar')
    @slot('email', $email)
@endcomponent

<div id="layoutSidenav">

@component('partials.admin.sidebar')
    @slot('email', $email)
@endcomponent

<div id="layoutSidenav_content">

<main id="contenido">

<header class="admin-page-heading"><div class="container"><p class="eyebrow mb-1">Administración</p><h1>@yield('title')</h1></div></header>

@yield('content')

</main>

@include('partials.admin.footer')

</div>

</div>

</body>

<script src="{{ asset('dist/fonts/all.js') }}"></script>
<script src="{{ asset('dist/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('dist/js/scripts.js') }}"></script>
<script src="{{ asset('dist/js/validation.js') }}"></script>
<script src="{{ asset('dist/js/redesign.js') }}"></script>

</html>
