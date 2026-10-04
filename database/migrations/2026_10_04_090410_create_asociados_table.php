<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asociados', function (Blueprint $table): void {
            $table->id();
            $table->string('nombre_completo');
            $table->string('cedula')->unique()->index();
            $table->date('fecha_nacimiento');
            $table->foreignId('provincia_id')->constrained('provincias');
            $table->foreignId('canton_id')->constrained('cantones');
            $table->string('ciudad');
            $table->text('direccion');
            $table->string('correo')->nullable()->unique();
            $table->string('telefono')->nullable();
            $table->string('password');
            $table->date('fecha_afiliacion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->enum('plan_cuota', ['mensual', 'trimestral', 'anual']);
            $table->date('pagado_hasta')->nullable();
            $table->boolean('moroso')->default(false)->index();
            $table->boolean('activo')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asociados');
    }
};
