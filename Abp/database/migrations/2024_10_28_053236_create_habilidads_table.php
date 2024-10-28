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
        Schema::create('habilidads', function (Blueprint $table) {
            $table->id();
            $table->String('nom_hab')->unique();
            $table->String('desc_habilidad');
            $table->foreignId('t_habilidad_id')->constrained('t_habilidads')->onDelete('cascade'); // Relación con tabla 'roles'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habilidads');
    }
};
