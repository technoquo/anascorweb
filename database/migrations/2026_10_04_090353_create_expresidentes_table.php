<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expresidentes', function (Blueprint $table): void {
            $table->id();
            $table->string('nombre');
            $table->string('foto');
            $table->unsignedSmallInteger('anio_inicio');
            $table->unsignedSmallInteger('anio_fin')->nullable();
            $table->unsignedInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expresidentes');
    }
};
