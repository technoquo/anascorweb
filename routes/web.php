<?php

use App\Livewire\AlbumDetalle;
use App\Livewire\Anascor\Academias;
use App\Livewire\Anascor\Convenios;
use App\Livewire\Anascor\Estructura;
use App\Livewire\Anascor\Expresidentes;
use App\Livewire\Anascor\Historia;
use App\Livewire\Anascor\NuestroTrabajo;
use App\Livewire\Anascor\QuienesSomos;
use App\Livewire\Asociados\CambiarPassword as AsociadoCambiarPassword;
use App\Livewire\Asociados\Ingresar as AsociadoIngresar;
use App\Livewire\Asociados\Perfil as AsociadoPerfil;
use App\Livewire\Buscar;
use App\Livewire\ComiteDetalle;
use App\Livewire\Comites;
use App\Livewire\Contacto;
use App\Livewire\EventoDetalle;
use App\Livewire\Eventos;
use App\Livewire\Galeria;
use App\Livewire\Inicio;
use App\Livewire\Lesco;
use App\Livewire\NoticiaDetalle;
use App\Livewire\Noticias;
use Illuminate\Support\Facades\Route;

Route::get('/', Inicio::class)->name('home');
Route::get('/noticias', Noticias::class)->name('noticias');
Route::get('/noticias/{slug}', NoticiaDetalle::class)->name('noticias.detalle');
Route::get('/eventos', Eventos::class)->name('eventos');
Route::get('/eventos/{slug}', EventoDetalle::class)->name('eventos.detalle');

// ANASCOR
Route::prefix('anascor')->name('anascor.')->group(function () {
    Route::get('/quienes-somos', QuienesSomos::class)->name('quienes-somos');
    Route::get('/nuestro-trabajo', NuestroTrabajo::class)->name('nuestro-trabajo');
    Route::get('/historia', Historia::class)->name('historia');
    Route::get('/estructura', Estructura::class)->name('estructura');
    Route::get('/expresidentes', Expresidentes::class)->name('expresidentes');
    Route::get('/academias', Academias::class)->name('academias');
    Route::get('/convenios', Convenios::class)->name('convenios');
});

// LESCO
Route::get('/lesco', Lesco::class)->name('lesco');

// Galería
Route::get('/galeria', Galeria::class)->name('galeria');
Route::get('/galeria/{slug}', AlbumDetalle::class)->name('galeria.album');

// Comités
Route::get('/comites', Comites::class)->name('comites');
Route::get('/comites/{slug}', ComiteDetalle::class)->name('comites.detalle');

// Contacto
Route::get('/contacto', Contacto::class)->name('contacto');

// Buscar
Route::get('/buscar', Buscar::class)->name('buscar');

// Asociados
Route::prefix('asociados')->name('asociados.')->group(function () {
    Route::get('/ingresar', AsociadoIngresar::class)->name('ingresar')->middleware('guest:asociado');
    Route::get('/cambiar-password', AsociadoCambiarPassword::class)->name('cambiar-password')->middleware('asociado.auth');
    Route::get('/perfil', AsociadoPerfil::class)->name('perfil')->middleware('asociado.auth');
});

// Redirecciones 301 desde URLs antiguas del sitio
Route::redirect('/quienes', '/anascor/quienes-somos', 301);
Route::redirect('/valores', '/anascor/nuestro-trabajo', 301);
Route::redirect('/expresidentes', '/anascor/expresidentes', 301);
Route::redirect('/estructura', '/anascor/estructura', 301);
Route::redirect('/historia', '/anascor/historia', 301);
Route::redirect('/academias', '/anascor/academias', 301);
Route::redirect('/convenios', '/anascor/convenios', 301);
Route::redirect('/galleria', '/galeria', 301);

Route::redirect('/dashboard', '/admin', 302)->name('dashboard');

require __DIR__.'/settings.php';
