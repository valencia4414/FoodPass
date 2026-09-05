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
        Schema::table('users', function (Blueprint $table) {
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('idioma_preferido')->default('es');
            $table->string('foto_perfil')->nullable();
            $table->string('membresia')->default('Básica');
            $table->timestamp('fecha_renovacion_membresia')->nullable();
            $table->integer('puntos_fp')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'telefono',
                'direccion',
                'idioma_preferido',
                'foto_perfil',
                'membresia',
                'fecha_renovacion_membresia',
                'puntos_fp',
            ]);
        });
    }
};
