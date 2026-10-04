<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comite_miembros', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('comite_id')->constrained('comites')->cascadeOnDelete();
            $table->string('nombre');
            $table->string('cargo');
            $table->text('descripcion');
            $table->string('foto')->nullable();
            $table->unsignedInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comite_miembros');
    }
};
