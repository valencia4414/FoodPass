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
    Schema::create('canjes', function (Blueprint $table) {
        $table->id();
        // Esto une el canje con el usuario que lo solicita
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // Para el historial: 'entregado', 'pendiente', 'cancelado'
        $table->string('estado')->default('entregado'); 
        
        // Para guardar el nombre del plato o beneficio (opcional pero recomendado)
        $table->string('detalle')->nullable(); 

        $table->timestamps(); // Esto nos da la fecha del canje automáticamente
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canjes');
    }
};
