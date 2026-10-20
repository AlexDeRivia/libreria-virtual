@extends('layouts.admin')

@section('title', 'Pedidos')

@section('content')

<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <span class="navbar-brand">Registro de pedidos</span>
        <a class="ms-auto btn btn-secondary" href="{{ route('admin.home') }}">
            <i aria-hidden="true" class="fa-solid fa-reply me-2"></i> Volver
        </a>
    </div>
</nav>

<div class="container">
    <div class="card my-3">
        <div class="card-header">Lista de Pedidos</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="mitabla3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Seguimiento simulado</th>
                        <th>Preferencia</th>
                        <th>Costo total</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Seguimiento simulado</th>
                        <th>Preferencia</th>
                        <th>Costo total</th>
                        <th>Detalle</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->nombre_usuario }}</td>
                        <td>{{ $pedido->direccion }}</td>
                        <td>{{ $pedido->telefono }}</td>
                        <td>{{ $pedido->fecha }}</td>
                        <td>{{ $pedido->estado }}</td>
                        <td>{{ $pedido->nro_tracking ?? 'Sin asignar' }}<br><small>{{ $pedido->estado_envio ?? 'Sin seguimiento' }}</small></td>
                        <td>{{ $pedido->preferencia }}</td>
                        <td>S/ {{ $pedido->costo_envio + $pedido->costo_pedido }}</td>
                        <td><a class="btn btn-outline-dark btn-sm" href="{{ route('admin.pedidos.show', $pedido->id) }}">Ver detalle</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="{{ asset('dist/js/datatables.js') }}"></script>
<script src="{{ asset('dist/js/mitable.js') }}"></script>

@endsection
