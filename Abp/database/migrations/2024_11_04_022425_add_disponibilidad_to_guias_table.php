<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('guias', function (Blueprint $table) {
        $table->boolean('disponibilidad')->default(true); // Agregar columna con valor por defecto
    });
}

public function down()
{
    Schema::table('guias', function (Blueprint $table) {
        $table->dropColumn('disponibilidad'); // Eliminar la columna si se hace rollback
    });
}

};
