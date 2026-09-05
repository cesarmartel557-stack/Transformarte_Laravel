<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gracias', function (Blueprint $table) {
            $table->id();
            $table->string('insignia')->default('MENSAJE RECIBIDO');
            $table->string('titulo')->default('Gracias por <em>tu mensaje</em>');
            $table->text('texto')->nullable();
            $table->text('texto_urgencia')->nullable();
            $table->string('boton_whatsapp_texto')->default('Escribir por WhatsApp');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gracias');
    }
};
