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
       Schema::create('transacciones', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('pedido_id')->constrained()->onDelete('cascade');
    $table->decimal('monto', 10, 2);
    $table->enum('metodo', ['nequi', 'efectivo', 'transferencia', 'tarjeta']);
    $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
    $table->string('referencia_externa')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
