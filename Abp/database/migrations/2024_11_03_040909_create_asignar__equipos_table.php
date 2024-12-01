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
        Schema::create('asignar__equipos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
            $table->foreignId('guia_id')->constrained('guias')->onDelete('cascade'); // Relación con tabla 'roles'
            $table->foreignId('actividad_id')->constrained('actividads')->onDelete('cascade'); // Relación con tabla 'roles'
            $table->date('fecha_programada');
            $table->date('fecha_devolucion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignar__equipos');
    }
};
