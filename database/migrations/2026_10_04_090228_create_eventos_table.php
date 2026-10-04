<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table): void {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->text('descripcion');
            $table->string('imagen')->nullable();
            $table->string('lugar');
            $table->dateTime('inicia_en')->index();
            $table->dateTime('termina_en')->nullable();
            $table->foreignId('comite_id')->nullable()->constrained('comites')->nullOnDelete();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
