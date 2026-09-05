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
        Schema::table('heroes', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('imagen');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('meta_keywords')->nullable()->after('meta_description');
            $table->string('meta_image')->nullable()->after('meta_keywords');
        });

        Schema::table('ebooks', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('pdf');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('meta_keywords')->nullable()->after('meta_description');
            $table->string('meta_image')->nullable()->after('meta_keywords');
        });

        Schema::table('gracias', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('boton_whatsapp_texto');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('meta_keywords')->nullable()->after('meta_description');
            $table->string('meta_image')->nullable()->after('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'meta_keywords', 'meta_image']);
        });

        Schema::table('ebooks', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'meta_keywords', 'meta_image']);
        });

        Schema::table('gracias', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'meta_keywords', 'meta_image']);
        });
    }
};
