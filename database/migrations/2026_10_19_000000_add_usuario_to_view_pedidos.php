<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $this->createView(true);
    }

    public function down(): void
    {
        $this->createView(false);
    }

    private function createView(bool $includeUsuario): void
    {
        $usuarioSelect = $includeUsuario ? "pedidos.usuario_id,\n" : '';
        $usuarioGroup = $includeUsuario ? "pedidos.usuario_id,\n" : '';

        DB::statement("CREATE OR REPLACE VIEW view_pedidos AS
            SELECT
                pedidos.id,
                {$usuarioSelect}
                CONCAT(usuarios.nombres, ' ', usuarios.apellidos) AS nombre_usuario,
                usuarios.telefono,
                IF(pedidos.empaquetado = 0, usuarios.direccion, direcciones.direccion) AS direccion,
                pedidos.fecha,
                pedidos.empaquetado,
                pedidos.entregado,
                pedidos.estado_pedido_id,
                estado_pedidos.estado AS estado,
                pedidos.costo_envio,
                pedidos.fecha_llegada,
                pedidos.envio_id,
                preferencia_envios.preferencia AS preferencia,
                SUM(linea_pedidos.cantidad * linea_pedidos.precio_unitario) AS costo_pedido
            FROM pedidos
            LEFT JOIN usuarios ON pedidos.usuario_id = usuarios.id
            LEFT JOIN direcciones ON pedidos.id = direcciones.id
            LEFT JOIN preferencia_envios ON pedidos.preferencia_envio_id = preferencia_envios.id
            LEFT JOIN estado_pedidos ON pedidos.estado_pedido_id = estado_pedidos.id
            LEFT JOIN linea_pedidos ON pedidos.id = linea_pedidos.pedido_id
            GROUP BY
                pedidos.id,
                {$usuarioGroup}
                nombre_usuario,
                usuarios.telefono,
                direccion,
                pedidos.fecha,
                pedidos.empaquetado,
                pedidos.entregado,
                pedidos.estado_pedido_id,
                estado_pedidos.estado,
                pedidos.costo_envio,
                pedidos.fecha_llegada,
                pedidos.envio_id,
                preferencia_envios.preferencia");
    }
};
