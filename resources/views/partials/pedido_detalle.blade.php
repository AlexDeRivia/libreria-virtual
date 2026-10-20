<div class="card my-4">
    <div class="card-header">Pedido P-{{ sprintf('%05d', $pedido->id) }}</div>
    <div class="card-body">
        <dl class="row mb-4">
            <dt class="col-sm-3">Cliente</dt><dd class="col-sm-9">{{ $pedido->nombre_usuario }}</dd>
            <dt class="col-sm-3">Teléfono</dt><dd class="col-sm-9">{{ $pedido->telefono }}</dd>
            <dt class="col-sm-3">Dirección</dt><dd class="col-sm-9">{{ $pedido->direccion }}</dd>
            <dt class="col-sm-3">Fecha</dt><dd class="col-sm-9">{{ $pedido->fecha ?? 'Sin confirmar' }}</dd>
            <dt class="col-sm-3">Estado del pedido</dt><dd class="col-sm-9">{{ $pedido->estado }}</dd>
            <dt class="col-sm-3">Preferencia de envío</dt><dd class="col-sm-9">{{ $pedido->preferencia ?? 'Sin definir' }}</dd>
            <dt class="col-sm-3">Seguimiento simulado</dt><dd class="col-sm-9">{{ $pedido->nro_tracking ?? 'Sin asignar' }}</dd>
            <dt class="col-sm-3">Estado del envío</dt><dd class="col-sm-9">{{ $pedido->estado_envio ?? 'Sin seguimiento' }}</dd>
            <dt class="col-sm-3">Llegada estimada</dt><dd class="col-sm-9">{{ $pedido->fecha_probable_llegada ?? 'Sin definir' }}</dd>
            <dt class="col-sm-3">Entrega registrada</dt><dd class="col-sm-9">{{ $pedido->fecha_llegada ?? 'Pendiente' }}</dd>
        </dl>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>Libro</th><th class="text-end">Cantidad</th><th class="text-end">Precio</th><th class="text-end">Subtotal</th></tr></thead>
                <tbody>
                    @foreach ($lineas as $linea)
                        <tr>
                            <td>{{ $linea->titulo }}</td>
                            <td class="text-end">{{ $linea->cantidad }}</td>
                            <td class="text-end">S/ {{ number_format($linea->precio_unitario, 2) }}</td>
                            <td class="text-end">S/ {{ number_format($linea->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="text-end mb-1">Productos: S/ {{ number_format($pedido->costo_pedido ?? 0, 2) }}</p>
        <p class="text-end mb-1">Envío simulado: S/ {{ number_format($pedido->costo_envio ?? 0, 2) }}</p>
        <p class="text-end fw-bold">Total: S/ {{ number_format(($pedido->costo_pedido ?? 0) + ($pedido->costo_envio ?? 0), 2) }}</p>
    </div>
</div>
