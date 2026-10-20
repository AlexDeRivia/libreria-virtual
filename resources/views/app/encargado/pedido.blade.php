@extends('layouts.encargado')

@section('title', 'Detalle del pedido')

@section('content')
<div class="container py-4">
    <a class="btn btn-secondary" href="{{ route('encargado.home') }}">Volver a envíos</a>
    @include('partials.pedido_detalle')
</div>
@endsection
