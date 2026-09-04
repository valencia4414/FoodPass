<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beneficiarios_sena', function (Blueprint $table): void {
            $table->id();
            $table->string('documento')->nullable()->unique();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->boolean('activo')->default(true);
            $table->timestamp('sincronizado_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beneficiarios_sena');
    }
};