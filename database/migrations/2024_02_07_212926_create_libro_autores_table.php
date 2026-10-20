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
        Schema::create('libro_autores', function (Blueprint $table) {

            $table->unsignedBigInteger('libro_id');
            $table->unsignedBigInteger('autor_id');

            $table->primary(['libro_id', 'autor_id']);

            $table->foreign('libro_id')->references('id')->on('libros');
            $table->foreign('autor_id')->references('id')->on('autores');
            $table->boolean('es_principal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_autores');
    }
};
