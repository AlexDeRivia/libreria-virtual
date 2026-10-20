@extends('layouts.admin')

@section('title', 'Detalle del pedido')

@section('content')
<div class="container py-4">
    <a class="btn btn-secondary" href="{{ route('admin.pedidos') }}">Volver a pedidos</a>
    @include('partials.pedido_detalle')
</div>
@endsection
