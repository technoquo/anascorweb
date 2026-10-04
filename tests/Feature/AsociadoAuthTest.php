<?php

use App\Models\Asociado;
use Illuminate\Support\Facades\Auth;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

// --- Login ---

it('muestra la página de ingreso', function () {
    $this->get(route('asociados.ingresar'))
        ->assertOk()
        ->assertSeeText('Área de Asociados');
});

it('permite ingresar con cédula y contraseña correctas', function () {
    Asociado::factory()->create(['cedula' => '101230001', 'password' => bcrypt('secreto123')]);

    \Livewire\Livewire::test(\App\Livewire\Asociados\Ingresar::class)
        ->set('cedula', '101230001')
        ->set('password', 'secreto123')
        ->call('ingresar')
        ->assertRedirect(route('asociados.perfil'));
});

it('rechaza credenciales incorrectas', function () {
    Asociado::factory()->create(['cedula' => '101230002', 'password' => bcrypt('secreto123')]);

    \Livewire\Livewire::test(\App\Livewire\Asociados\Ingresar::class)
        ->set('cedula', '101230002')
        ->set('password', 'incorrecta')
        ->call('ingresar')
        ->assertHasErrors('cedula');
});

it('rechaza asociados inactivos', function () {
    Asociado::factory()->inactivo()->create(['cedula' => '101230003', 'password' => bcrypt('secreto123')]);

    \Livewire\Livewire::test(\App\Livewire\Asociados\Ingresar::class)
        ->set('cedula', '101230003')
        ->set('password', 'secreto123')
        ->call('ingresar')
        ->assertHasErrors('cedula');
});

it('redirige a cambiar contraseña si debe_cambiar_password es true', function () {
    Asociado::factory()->debecambiar()->create(['cedula' => '101230004', 'password' => bcrypt('temporal')]);

    \Livewire\Livewire::test(\App\Livewire\Asociados\Ingresar::class)
        ->set('cedula', '101230004')
        ->set('password', 'temporal')
        ->call('ingresar')
        ->assertRedirect(route('asociados.cambiar-password'));
});

// --- Seguridad: acceso sin autenticación ---

it('redirige al login si accede a perfil sin autenticar', function () {
    $this->get(route('asociados.perfil'))
        ->assertRedirect(route('asociados.ingresar'));
});

it('redirige al login si accede a cambiar-password sin autenticar', function () {
    $this->get(route('asociados.cambiar-password'))
        ->assertRedirect(route('asociados.ingresar'));
});

// --- Seguridad: aislamiento entre asociados ---

it('un asociado autenticado solo ve sus propios datos en el perfil', function () {
    $asociadoA = Asociado::factory()->create();
    $asociadoB = Asociado::factory()->create();

    \Livewire\Livewire::actingAs($asociadoA, 'asociado')
        ->test(\App\Livewire\Asociados\Perfil::class)
        ->assertSeeText($asociadoA->nombre_completo)
        ->assertDontSeeText($asociadoB->cedula);
});

// --- Seguridad: asociado no puede acceder al panel admin ---

it('un asociado autenticado no puede acceder a /admin', function () {
    $asociado = Asociado::factory()->create();

    $this->actingAs($asociado, 'asociado')
        ->get('/admin')
        ->assertRedirect();

    expect(Auth::guard('web')->check())->toBeFalse();
});
