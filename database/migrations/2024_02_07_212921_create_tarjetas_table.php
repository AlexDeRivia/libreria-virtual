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
        Schema::create('tarjetas', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 16);
            $table->date('fecha_caducidad');
            $table->string('codigo', 4);
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->foreignId('tipo_tarjeta_id')->constrained('tipo_tarjetas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarjetas');
    }
};
