<?php

namespace App\Livewire\Asociados;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Ingreso de Asociados — ANASCOR')]
#[Layout('layouts.public.base')]
class Ingresar extends Component
{
    public string $cedula = '';

    public string $password = '';

    public bool $recuerdame = false;

    public function ingresar(): void
    {
        $key = 'asociado-login:'.Str::lower($this->cedula).'|'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $segundos = RateLimiter::availableIn($key);
            $this->addError('cedula', "Demasiados intentos. Intenta de nuevo en {$segundos} segundos.");

            return;
        }

        $this->validate([
            'cedula' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'cedula.required' => 'La cédula es obligatoria.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if (! Auth::guard('asociado')->attempt(
            ['cedula' => $this->cedula, 'password' => $this->password, 'activo' => true],
            $this->recuerdame
        )) {
            RateLimiter::hit($key, 300);
            $this->addError('cedula', 'La cédula o contraseña son incorrectas.');

            return;
        }

        RateLimiter::clear($key);

        $asociado = Auth::guard('asociado')->user();

        if ($asociado->debe_cambiar_password) {
            $this->redirect(route('asociados.cambiar-password'), navigate: true);

            return;
        }

        $this->redirect(route('asociados.perfil'), navigate: true);
    }

    public function render()
    {
        return view('livewire.asociados.ingresar');
    }
}
