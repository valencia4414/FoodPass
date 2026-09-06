<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tarea 96 – Agregar campos faltantes a la tabla canjes para RF13/RF14/RF15.
     */
    public function up(): void
    {
        Schema::table('canjes', function (Blueprint $table): void {
            if (!Schema::hasColumn('canjes', 'restaurante_id')) {
                $table->foreignId('restaurante_id')
                      ->nullable()
                      ->after('user_id')
                      ->constrained('restaurantes')
                      ->nullOnDelete();
            }

            if (!Schema::hasColumn('canjes', 'monto')) {
                $table->decimal('monto', 10, 2)->default(0)->after('restaurante_id');
            }

            if (!Schema::hasColumn('canjes', 'fecha_canje')) {
                $table->date('fecha_canje')->nullable()->after('monto');
            }

            if (!Schema::hasColumn('canjes', 'periodo')) {
                $table->string('periodo')->nullable()->after('fecha_canje');
            }
        });
    }

    public function down(): void
    {
        Schema::table('canjes', function (Blueprint $table): void {
            if (Schema::hasColumn('canjes', 'restaurante_id')) {
                $table->dropConstrainedForeignId('restaurante_id');
            }
            if (Schema::hasColumn('canjes', 'monto')) {
                $table->dropColumn('monto');
            }
            if (Schema::hasColumn('canjes', 'fecha_canje')) {
                $table->dropColumn('fecha_canje');
            }
            if (Schema::hasColumn('canjes', 'periodo')) {
                $table->dropColumn('periodo');
            }
        });
    }
};
