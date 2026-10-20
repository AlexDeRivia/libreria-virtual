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
        Schema::create('libro_especialidades', function (Blueprint $table) {

            $table->unsignedBigInteger('libro_id');
            $table->unsignedBigInteger('especialidad_id');

            $table->primary(['libro_id', 'especialidad_id']);

            $table->foreign('libro_id')->references('id')->on('libros');
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_especialidades');
    }
};
