<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("CREATE OR REPLACE VIEW view_autores_nacionalidades AS
        SELECT
            A.id AS id,
            A.nombres AS nombres,
            A.apellidos AS apellidos,
            N.nacionalidad AS nacionalidad
        FROM autores A
        JOIN nacionalidades N ON A.nacionalidad_id = N.id;");

        DB::unprepared("CREATE OR REPLACE VIEW view_all_ejemplares AS
        SELECT
            ej.id,
            l.titulo,
            l.resumen,
            l.isbn,
            ej.numero_ejemplar,
            ej.precio,
            ej.stock,
            GROUP_CONCAT(CONCAT(a.nombres, ' ', a.apellidos) SEPARATOR ', ') AS autores,
            i.idioma
        FROM libros l
        INNER JOIN libro_autores la ON l.id = la.libro_id
        INNER JOIN autores a ON la.autor_id = a.id
        INNER JOIN ejemplares ej ON l.id = ej.libro_id
        INNER JOIN idiomas i ON ej.idioma_id = i.id
        GROUP BY ej.id, l.titulo, l.resumen, l.isbn, ej.numero_ejemplar, ej.precio, ej.stock, i.idioma;");

        DB::unprepared("CREATE OR REPLACE VIEW view_tarjetas AS
        SELECT
            t.id,
            t.numero,
            t.fecha_caducidad,
            t.codigo,
            t.usuario_id,
            tt.tipo AS tipo
        FROM tarjetas t
        JOIN tipo_tarjetas tt ON t.tipo_tarjeta_id = tt.id;");

        DB::unprepared("CREATE OR REPLACE VIEW view_linea_pedidos AS
        SELECT 
            lp.id AS id,
            lp.pedido_id AS pedido_id,
            lp.ejemplar_id AS ejemplar_id,
            l.titulo AS titulo,
            lp.cantidad AS cantidad,
            lp.precio_unitario AS precio_unitario,
            lp.cantidad * lp.precio_unitario AS subtotal
        FROM linea_pedidos lp
            INNER JOIN ejemplares e ON lp.ejemplar_id = e.id
            INNER JOIN libros l ON e.libro_id = l.id;");

        DB::unprepared("CREATE OR REPLACE VIEW view_pedidos AS
        SELECT 
            pedidos.id,
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
            preferencia_envios.preferencia;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (['view_pedidos', 'view_linea_pedidos', 'view_tarjetas', 'view_all_ejemplares', 'view_autores_nacionalidades'] as $view) {
            DB::unprepared("DROP VIEW IF EXISTS {$view}");
        }
    }
};
