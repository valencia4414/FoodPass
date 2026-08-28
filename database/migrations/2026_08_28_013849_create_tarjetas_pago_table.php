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
        Schema::create('tarjetas_pago', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->enum('tipo', ['visa', 'mastercard', 'nequi']);
    $table->string('ultimos_4_digitos', 4);
    $table->unsignedTinyInteger('mes_vencimiento');
    $table->unsignedSmallInteger('año_vencimiento');
    $table->boolean('predeterminada')->default(false);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarjetas_pago');
    }
};
