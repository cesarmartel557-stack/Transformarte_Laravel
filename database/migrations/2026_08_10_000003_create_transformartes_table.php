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
        Schema::create('transformartes', function (Blueprint $table) {
            $table->id();
            $table->string('insignia');
            $table->string('titulo');
            $table->text('parrafo_1');
            $table->text('parrafo_2');
            $table->string('imagen')->nullable();
            $table->timestamps();
        });

        Schema::create('transformarte_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transformarte_id')->nullable()->constrained('transformartes')->cascadeOnDelete();
            $table->string('icono')->nullable();
            $table->string('titulo');
            $table->text('texto');
            $table->integer('orden')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transformarte_items');
        Schema::dropIfExists('transformartes');
    }
};
