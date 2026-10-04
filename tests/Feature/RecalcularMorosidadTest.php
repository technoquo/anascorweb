<?php

use App\Mail\NuevosMorososMail;
use App\Models\Ajuste;
use App\Models\Asociado;
use Illuminate\Support\Facades\Mail;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    // Asegurar que el ajuste de días de gracia exista
    Ajuste::updateOrCreate(['clave' => 'dias_gracia'], ['valor' => '3']);
    Ajuste::updateOrCreate(['clave' => 'correo_tesoreria'], ['valor' => 'tesoanascor@gmail.com']);
});

it('marca como moroso al asociado con pagado_hasta vencido', function () {
    $asociado = Asociado::factory()->create([
        'moroso' => false,
        'pagado_hasta' => now()->subDays(10)->toDateString(),
    ]);

    $this->artisan('app:recalcular-morosidad')->assertSuccessful();

    expect($asociado->fresh()->moroso)->toBeTrue();
});

it('no marca como moroso al asociado con pagado_hasta vigente', function () {
    $asociado = Asociado::factory()->create([
        'moroso' => false,
        'pagado_hasta' => now()->addMonth()->toDateString(),
    ]);

    $this->artisan('app:recalcular-morosidad')->assertSuccessful();

    expect($asociado->fresh()->moroso)->toBeFalse();
});

it('respeta los días de gracia configurados', function () {
    Ajuste::where('clave', 'dias_gracia')->update(['valor' => '5']);

    // Vencido hace 3 días — dentro de los 5 días de gracia
    $alDia = Asociado::factory()->create([
        'moroso' => false,
        'pagado_hasta' => now()->subDays(3)->toDateString(),
    ]);

    // Vencido hace 6 días — fuera de los 5 días de gracia
    $moroso = Asociado::factory()->create([
        'moroso' => false,
        'pagado_hasta' => now()->subDays(6)->toDateString(),
    ]);

    $this->artisan('app:recalcular-morosidad')->assertSuccessful();

    expect($alDia->fresh()->moroso)->toBeFalse();
    expect($moroso->fresh()->moroso)->toBeTrue();
});

it('quita la morosidad al asociado que pagó', function () {
    $asociado = Asociado::factory()->create([
        'moroso' => true,
        'pagado_hasta' => now()->addMonth()->toDateString(),
    ]);

    $this->artisan('app:recalcular-morosidad')->assertSuccessful();

    expect($asociado->fresh()->moroso)->toBeFalse();
});

it('envía correo a tesorería solo cuando hay nuevos morosos', function () {
    Mail::fake();

    // Sin morosos nuevos
    Asociado::factory()->create([
        'moroso' => false,
        'pagado_hasta' => now()->addMonth()->toDateString(),
    ]);

    $this->artisan('app:recalcular-morosidad')->assertSuccessful();
    Mail::assertNothingSent();

    // Con moroso nuevo
    Asociado::factory()->create([
        'moroso' => false,
        'pagado_hasta' => now()->subDays(10)->toDateString(),
    ]);

    $this->artisan('app:recalcular-morosidad')->assertSuccessful();
    Mail::assertSent(NuevosMorososMail::class);
});

it('no procesa asociados inactivos', function () {
    $inactivo = Asociado::factory()->inactivo()->create([
        'moroso' => false,
        'pagado_hasta' => now()->subDays(30)->toDateString(),
    ]);

    $this->artisan('app:recalcular-morosidad')->assertSuccessful();

    expect($inactivo->fresh()->moroso)->toBeFalse();
});
