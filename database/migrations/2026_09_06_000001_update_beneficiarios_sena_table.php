<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tarea 95 – Alinear tabla beneficiarios_sena con los requisitos RF13.
     * Renombra columnas existentes para coincidir con la especificación.
     */
    public function up(): void
    {
        Schema::table('beneficiarios_sena', function (Blueprint $table): void {
            // Renombrar 'documento' → 'numero_documento'
            if (Schema::hasColumn('beneficiarios_sena', 'documento') && !Schema::hasColumn('beneficiarios_sena', 'numero_documento')) {
                $table->renameColumn('documento', 'numero_documento');
            }

            // Renombrar 'nombre' → 'nombre_completo'
            if (Schema::hasColumn('beneficiarios_sena', 'nombre') && !Schema::hasColumn('beneficiarios_sena', 'nombre_completo')) {
                $table->renameColumn('nombre', 'nombre_completo');
            }
        });
    }

    public function down(): void
    {
        Schema::table('beneficiarios_sena', function (Blueprint $table): void {
            if (Schema::hasColumn('beneficiarios_sena', 'numero_documento') && !Schema::hasColumn('beneficiarios_sena', 'documento')) {
                $table->renameColumn('numero_documento', 'documento');
            }

            if (Schema::hasColumn('beneficiarios_sena', 'nombre_completo') && !Schema::hasColumn('beneficiarios_sena', 'nombre')) {
                $table->renameColumn('nombre_completo', 'nombre');
            }
        });
    }
};
