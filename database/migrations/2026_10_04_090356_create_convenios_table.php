<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('convenios', function (Blueprint $table): void {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('imagen');
            $table->string('url');
            $table->tinyInteger('status')->default(1);
            $table->unsignedInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('convenios');
    }
};
