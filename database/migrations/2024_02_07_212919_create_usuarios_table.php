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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('telefono', 11);
            $table->boolean('pedido_1_clic');
            $table->foreignId('rol_id')->constrained('roles');
            $table->foreignId('pais_id')->constrained('paises');
            $table->foreignId('provincia_id')->constrained('provincias');
            $table->string('localidad');
            $table->string('direccion');
            $table->string('codigo_postal', 20);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
