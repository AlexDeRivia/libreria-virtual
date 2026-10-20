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
        foreach ($this->procedures() as $procedure) {
            DB::unprepared("DROP PROCEDURE IF EXISTS {$procedure}");
        }

        DB::unprepared("CREATE PROCEDURE sp_agregar_linea(
            IN pedido_id_param bigint UNSIGNED,
            IN ejemplar_id_param bigint UNSIGNED,
            IN cantidad_param int
        )
        BEGIN
            DECLARE stock_actual int;
            DECLARE cantidad_existente int;
            
            -- Obtener el stock actual del ejemplar
            SELECT stock INTO stock_actual
            FROM ejemplares
            WHERE id = ejemplar_id_param;
            
            -- Verificar si ya existe una línea para este ejemplar en el pedido
            SELECT COUNT(*) INTO cantidad_existente
            FROM linea_pedidos
            WHERE pedido_id = pedido_id_param
            AND ejemplar_id = ejemplar_id_param;
            
            IF cantidad_existente > 0 THEN
                -- Actualizar la cantidad de la línea existente y restar del stock
                UPDATE linea_pedidos
                SET cantidad = cantidad + cantidad_param,
                    updated_at = NOW()
                WHERE pedido_id = pedido_id_param
                AND ejemplar_id = ejemplar_id_param;
            ELSE
                -- Insertar una nueva línea y restar del stock
                INSERT INTO linea_pedidos (pedido_id, ejemplar_id, cantidad, precio_unitario, created_at, updated_at)
                VALUES (pedido_id_param, ejemplar_id_param, cantidad_param, (SELECT precio FROM ejemplares WHERE id = ejemplar_id_param), NOW(), NOW());
            END IF;
            
            -- Actualizar el stock del ejemplar
            UPDATE ejemplares
            SET stock = stock_actual - cantidad_param,
                updated_at = NOW()
            WHERE id = ejemplar_id_param;
        END");

        DB::unprepared("CREATE PROCEDURE sp_eliminar_linea(
            IN p_id BIGINT
        )
        BEGIN
            DECLARE v_ejemplar_id BIGINT;
            DECLARE v_cantidad INT;
            
            -- Obtener el ejemplar y la cantidad de la línea del pedido
            SELECT ejemplar_id, cantidad INTO v_ejemplar_id, v_cantidad
            FROM linea_pedidos
            WHERE id = p_id;
            
            -- Aumentar el stock del ejemplar
            UPDATE ejemplares
            SET stock = stock + v_cantidad
            WHERE id = v_ejemplar_id;
            
            -- Eliminar la línea del pedido
            DELETE FROM linea_pedidos
            WHERE id = p_id;
        END");

        DB::unprepared("CREATE PROCEDURE sp_add_ejemplar_linea(IN linea_id BIGINT UNSIGNED)
        BEGIN
            DECLARE ejemplar_id_var BIGINT UNSIGNED;
            DECLARE cantidad_var INT;
        
            -- Obtener el ejemplar_id y cantidad de la línea de pedidos
            SELECT ejemplar_id, cantidad INTO ejemplar_id_var, cantidad_var FROM linea_pedidos WHERE id = linea_id;
        
            -- Aumentar la cantidad en 1 y reducir el stock en 1 del ejemplar
            UPDATE linea_pedidos SET cantidad = cantidad_var + 1 WHERE id = linea_id;
            UPDATE ejemplares SET stock = stock - 1 WHERE id = ejemplar_id_var;
        END");

        DB::unprepared("CREATE PROCEDURE sp_sub_ejemplar_linea(IN linea_id BIGINT UNSIGNED)
        BEGIN
            DECLARE ejemplar_id_var BIGINT UNSIGNED;
            DECLARE cantidad_var INT;
        
            -- Obtener el ejemplar_id y cantidad de la línea de pedidos
            SELECT ejemplar_id, cantidad INTO ejemplar_id_var, cantidad_var FROM linea_pedidos WHERE id = linea_id;
        
            -- Reducir la cantidad en 1 y aumentar el stock en 1 del ejemplar
            UPDATE linea_pedidos SET cantidad = cantidad_var - 1 WHERE id = linea_id;
            UPDATE ejemplares SET stock = stock + 1 WHERE id = ejemplar_id_var;
        END");

        DB::unprepared("CREATE PROCEDURE sp_efectuar_compra(
            IN p_pedido_id bigint(20),
            IN p_pedido_fecha date,
            IN p_pedido_empaquetado tinyint(1),
            IN p_pedido_costo_envio double(8,2),
            IN p_pedido_preferencia_envio_id bigint(20),
            IN p_direcciones_direccion varchar(255),
            IN p_direcciones_mensaje text
        )
        BEGIN
            -- PASO 1: Actualizar el estado del pedido y establecer los detalles del pedido
            UPDATE pedidos
            SET estado_pedido_id = 2,
                empaquetado = p_pedido_empaquetado,
                fecha = p_pedido_fecha,
                costo_envio = p_pedido_costo_envio,
                preferencia_envio_id = p_pedido_preferencia_envio_id
            WHERE id = p_pedido_id;
        
            -- Verificar si el pedido está empaquetado
            IF p_pedido_empaquetado = 1 THEN
                -- PASO 1 (Continuación): Crear una nueva dirección
                INSERT INTO direcciones (id, direccion, mensaje, created_at, updated_at)
                VALUES (p_pedido_id, p_direcciones_direccion, p_direcciones_mensaje, NOW(), NOW());
            END IF;
        
            -- PASO 2: Crear un nuevo registro en pedidos
            INSERT INTO pedidos (usuario_id, empaquetado, estado_pedido_id, created_at, updated_at)
            SELECT usuario_id, FALSE, 1, NOW(), NOW()
            FROM pedidos
            WHERE id = p_pedido_id;
        
        END");

        DB::unprepared("CREATE PROCEDURE sp_ejemplares_por_especialidad(IN usuario_id INT, IN query VARCHAR(255))
        BEGIN
            SELECT
                ej.id,
                l.titulo AS titulo,
                ej.numero_ejemplar,
                ej.precio,
                ej.stock,
                GROUP_CONCAT(CONCAT(a.nombres, ' ', a.apellidos) SEPARATOR ', ') AS autores,
                i.idioma
            FROM libros l
            INNER JOIN libro_especialidades le ON l.id = le.libro_id
            INNER JOIN especialidades e ON le.especialidad_id = e.id
            INNER JOIN libro_autores la ON l.id = la.libro_id
            INNER JOIN autores a ON la.autor_id = a.id
            INNER JOIN ejemplares ej ON l.id = ej.libro_id
            INNER JOIN idiomas i ON ej.idioma_id = i.id
            INNER JOIN usuario_especialidades ue ON e.id = ue.especialidad_id
            WHERE ue.usuario_id = usuario_id
            AND (
                (query = '' OR l.titulo COLLATE utf8mb4_unicode_ci LIKE CONCAT('%', query COLLATE utf8mb4_unicode_ci, '%')) OR
                (query = '' OR a.nombres COLLATE utf8mb4_unicode_ci LIKE CONCAT('%', query COLLATE utf8mb4_unicode_ci, '%')) OR
                (query = '' OR a.apellidos COLLATE utf8mb4_unicode_ci LIKE CONCAT('%', query COLLATE utf8mb4_unicode_ci, '%'))
            )
            GROUP BY ej.id, l.titulo, ej.numero_ejemplar, ej.precio, ej.stock, i.idioma;
        END");

        DB::unprepared("CREATE PROCEDURE sp_perfil (IN usuario_id INT)
        BEGIN
            SELECT
                u.id,
                u.email,
                u.nombres AS nombres,
                u.apellidos AS apellidos,
                u.telefono,
                u.pedido_1_clic,
                r.rol AS rol,
                p.nombre AS pais,
                pr.nombre AS provincia,
                u.localidad,
                u.direccion,
                u.codigo_postal
            FROM usuarios u
            LEFT JOIN roles r ON u.rol_id = r.id
            LEFT JOIN paises p ON u.pais_id = p.id
            LEFT JOIN provincias pr ON u.provincia_id = pr.id
            LEFT JOIN usuario_especialidades ue ON u.id = ue.usuario_id
            LEFT JOIN especialidades e ON ue.especialidad_id = e.id
            WHERE u.id = usuario_id;
        END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->procedures() as $procedure) {
            DB::unprepared("DROP PROCEDURE IF EXISTS {$procedure}");
        }
    }

    private function procedures(): array
    {
        return [
            'sp_agregar_linea',
            'sp_eliminar_linea',
            'sp_add_ejemplar_linea',
            'sp_sub_ejemplar_linea',
            'sp_efectuar_compra',
            'sp_ejemplares_por_especialidad',
            'sp_perfil',
        ];
    }
};
