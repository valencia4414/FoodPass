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
       Schema::create('pedidos', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->constrained()->onDelete('cascade');
         $table->foreignId('restaurante_id')->constrained('restaurantes')->onDelete('cascade');
         $table->enum('estado', ['pendiente', 'en_preparacion', 'entregado', 'cancelado'])->default('pendiente');
         $table->decimal('total', 10, 2);
         $table->enum('metodo_pago', ['efectivo', 'transferencia', 'nequi', 'tarjeta']);
         $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
