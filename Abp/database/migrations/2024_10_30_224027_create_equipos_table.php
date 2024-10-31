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
            $table->id(); // Definir id principal con nombre específico
            $table->string('nom_equipo', 100);
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->text('descripcion')->nullable(); 
            $table->integer('cantidad')->default(0); 
            $table->timestamps();

        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
