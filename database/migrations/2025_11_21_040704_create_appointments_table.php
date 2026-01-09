<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('service_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('preferred_date');
            $table->time('preferred_time');
            $table->enum('mode', ['presencial', 'online'])->default('presencial');
            $table->enum('status', ['pendiente', 'confirmada', 'cancelada'])->default('pendiente');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};