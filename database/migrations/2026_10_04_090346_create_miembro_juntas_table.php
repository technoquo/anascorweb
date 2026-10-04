<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('miembros_junta', function (Blueprint $table): void {
            $table->id();
            $table->string('nombre');
            $table->string('puesto');
            $table->string('foto');
            $table->string('periodo');
            $table->unsignedInteger('orden')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('miembros_junta');
    }
};
