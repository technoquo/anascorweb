<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('albumes', function (Blueprint $table): void {
            $table->id();
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->unsignedSmallInteger('anio');
            $table->string('portada');
            $table->text('descripcion')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albumes');
    }
};
