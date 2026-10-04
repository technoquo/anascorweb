<?php

use App\Livewire\Inicio;
use Illuminate\Support\Facades\Route;

Route::get('/', Inicio::class)->name('home');

// Redirecciones 301 desde URLs antiguas del sitio
Route::redirect('/quienes', '/anascor/quienes-somos', 301);
Route::redirect('/valores', '/anascor/nuestro-trabajo', 301);
Route::redirect('/expresidentes', '/anascor/expresidentes', 301);
Route::redirect('/estructura', '/anascor/estructura', 301);
Route::redirect('/historia', '/anascor/historia', 301);
Route::redirect('/academias', '/anascor/academias', 301);
Route::redirect('/convenios', '/anascor/convenios', 301);
Route::redirect('/galleria', '/galeria', 301);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
