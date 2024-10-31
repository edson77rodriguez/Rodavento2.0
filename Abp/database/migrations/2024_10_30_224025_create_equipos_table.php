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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id('id_equipo'); // Definir id principal con nombre específico
            $table->string('nom_equipo', 100); // Nombre del equipo con un límite de caracteres
            $table->unsignedBigInteger('id'); // Llave foránea para la categoría
            $table->text('descripcion')->nullable(); // Descripción del equipo, permitiendo valores nulos
            $table->integer('cantidad')->default(0); // Cantidad de equipos, por defecto 0
            $table->timestamps();

            // Definir la relación con la tabla de categorías (ajustar según el nombre de la tabla de categorías)
            $table->foreign('id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
