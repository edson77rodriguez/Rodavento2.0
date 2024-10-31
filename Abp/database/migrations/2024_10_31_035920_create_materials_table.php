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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->String('codigo_m')->unique();
            $table->foreignId('id_equipo')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('estado_e_id')->constrained('estado_equipos')->onDelete('cascade');
            $table->date('fecha_asignacion');
            $table->date('fecha_mantenimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
