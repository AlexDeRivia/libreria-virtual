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
        DB::unprepared("DROP TRIGGER IF EXISTS insert_pedido_after_usuario_insert");
        DB::unprepared("CREATE TRIGGER insert_pedido_after_usuario_insert
        AFTER INSERT ON usuarios
        FOR EACH ROW
        BEGIN
            IF NEW.rol_id IN (2, 3) THEN
                INSERT INTO pedidos (usuario_id, empaquetado, estado_pedido_id, created_at, updated_at)
                VALUES (NEW.id, FALSE, 1, NOW(), NOW());
            END IF;
        END;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS insert_pedido_after_usuario_insert;");
    }
};
