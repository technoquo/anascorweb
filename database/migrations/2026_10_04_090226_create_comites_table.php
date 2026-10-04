<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comites', function (Blueprint $table): void {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->string('logo');
            $table->text('descripcion');
            $table->unsignedInteger('orden')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comites');
    }
};
