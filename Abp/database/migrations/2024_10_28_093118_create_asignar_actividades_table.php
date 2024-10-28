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
        Schema::create('asignar_actividades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guia_id')->constrained('users')->onDelete('cascade'); // Relación con tabla 'roles'
            $table->foreignId('supervisor_id')->constrained('users')->onDelete('cascade'); // Relación con tabla 'roles'
            $table->foreignId('encargado_id')->constrained('users')->onDelete('cascade'); // Relación con tabla 'roles'
            $table->foreignId('actividad_id')->constrained('actividads')->onDelete('cascade'); // Relación con tabla 'roles'
            $table->date('fecha_asignada');
            $table->foreignId('estado_a_id')->constrained('estado_actividads')->onDelete('cascade'); // Relación con tabla 'roles'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignar_actividades');
    }
};
