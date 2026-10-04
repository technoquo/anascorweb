<?php

namespace App\Livewire\Asociados;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cambiar Contraseña — ANASCOR')]
#[Layout('layouts.public.base')]
class CambiarPassword extends Component
{
    public string $password_actual = '';

    public string $password_nuevo = '';

    public string $password_nuevo_confirmation = '';

    public function mount(): void
    {
        if (! Auth::guard('asociado')->check()) {
            $this->redirect(route('asociados.ingresar'), navigate: true);
        }
    }

    public function cambiar(): void
    {
        $asociado = Auth::guard('asociado')->user();

        $this->validate([
            'password_actual' => ['required', 'string'],
            'password_nuevo' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password_actual.required' => 'La contraseña actual es obligatoria.',
            'password_nuevo.required' => 'La nueva contraseña es obligatoria.',
            'password_nuevo.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'password_nuevo.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        if (! Hash::check($this->password_actual, $asociado->password)) {
            $this->addError('password_actual', 'La contraseña actual es incorrecta.');

            return;
        }

        $asociado->update([
            'password' => $this->password_nuevo,
            'debe_cambiar_password' => false,
        ]);

        $this->redirect(route('asociados.perfil'), navigate: true);
    }

    public function render()
    {
        return view('livewire.asociados.cambiar-password');
    }
}
