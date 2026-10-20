<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->date('fecha')->nullable();
            $table->boolean('empaquetado')->nullable();
            $table->foreignId('estado_pedido_id')->constrained('estado_pedidos');
            $table->float('costo_envio')->nullable();
            $table->date('fecha_llegada')->nullable();
            $table->unsignedBigInteger('envio_id')->nullable();
            $table->unsignedBigInteger('preferencia_envio_id')->nullable();
            $table->boolean('entregado')->default(false);
            $table->foreign('envio_id')->references('id')->on('envios');
            $table->foreign('preferencia_envio_id')->references('id')->on('preferencia_envios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
