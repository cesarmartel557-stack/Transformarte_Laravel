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
        Schema::create('formato_sesiones', function (Blueprint $table) {
            $table->id();
            $table->string('insignia');
            $table->string('titulo');
            $table->text('parrafo_1');
            $table->text('parrafo_2')->nullable();
            $table->string('detalle');
            $table->string('boton_texto');
            $table->string('boton_url');
            $table->integer('orden')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formato_sesiones');
    }
};
