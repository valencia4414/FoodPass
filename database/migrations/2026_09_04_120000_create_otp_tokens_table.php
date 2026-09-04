<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('otp_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('token');
            $table->timestamp('expira_en');
            $table->boolean('usado')->default(false);
            $table->timestamps();

            $table->index(['user_id', 'usado']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otp_tokens');
    }
}; 
