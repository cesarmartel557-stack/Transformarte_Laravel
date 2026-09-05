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
        Schema::create('sobre_mis', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('parrafo_1');
            $table->text('parrafo_2');
            $table->string('imagen')->nullable();
            $table->string('imagen_felino')->nullable();
            $table->string('cta_texto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sobre_mis');
    }
};
