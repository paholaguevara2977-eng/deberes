<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deberes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 120);
            $table->string('materia', 20);
            $table->string('estudiante', 80);
            $table->text('descripcion')->nullable();
            $table->string('archivo');
            $table->string('nombre_original');
            $table->string('mime')->nullable();
            $table->unsignedBigInteger('tamano')->default(0);
            $table->timestamps();

            $table->index('materia');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deberes');
    }
};
