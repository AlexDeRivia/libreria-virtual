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
        Schema::create('usuario_especialidades', function (Blueprint $table) {

            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('especialidad_id');

            $table->primary(['usuario_id', 'especialidad_id']);

            $table->foreign('usuario_id')->references('id')->on('usuarios');
	        $table->foreign('especialidad_id')->references('id')->on('especialidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_especialidades');
    }
};
