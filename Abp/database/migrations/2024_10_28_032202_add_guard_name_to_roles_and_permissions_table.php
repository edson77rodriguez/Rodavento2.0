<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // En la migración recién creada, agrega lo siguiente:
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('guard_name')->default('web'); // o el nombre del guard que estés usando
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->string('guard_name')->default('web');
        });
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('guard_name');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('guard_name');
        });
    }
};
