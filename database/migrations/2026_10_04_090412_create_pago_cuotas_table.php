<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagos_cuota', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('asociado_id')->constrained('asociados')->cascadeOnDelete();
            $table->enum('plan', ['mensual', 'trimestral', 'anual']);
            $table->decimal('monto', 10, 2);
            $table->date('cubre_desde');
            $table->date('cubre_hasta');
            $table->date('pagado_en');
            $table->string('comprobante')->nullable();
            $table->foreignId('registrado_por')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos_cuota');
    }
};
