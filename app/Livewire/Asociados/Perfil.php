<?php

namespace App\Livewire\Asociados;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Mi Perfil — ANASCOR')]
#[Layout('layouts.public.base')]
class Perfil extends Component
{
    public string $ciudad = '';

    public string $direccion = '';

    public string $correo = '';

    public string $telefono = '';

    public bool $editando = false;

    public bool $guardado = false;

    public function mount(): void
    {
        $asociado = Auth::guard('asociado')->user();

        $this->ciudad = $asociado->ciudad ?? '';
        $this->direccion = $asociado->direccion ?? '';
        $this->correo = $asociado->correo ?? '';
        $this->telefono = $asociado->telefono ?? '';
    }

    public function guardar(): void
    {
        $this->validate([
            'ciudad' => ['required', 'string', 'max:100'],
            'direccion' => ['required', 'string', 'max:500'],
            'correo' => ['nullable', 'email', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:20'],
        ], [
            'ciudad.required' => 'La ciudad es obligatoria.',
            'direccion.required' => 'La dirección es obligatoria.',
            'correo.email' => 'Ingresa un correo electrónico válido.',
        ]);

        Auth::guard('asociado')->user()->update([
            'ciudad' => $this->ciudad,
            'direccion' => $this->direccion,
            'correo' => $this->correo ?: null,
            'telefono' => $this->telefono ?: null,
        ]);

        $this->editando = false;
        $this->guardado = true;
    }

    public function salir(): void
    {
        Auth::guard('asociado')->logout();
        session()->invalidate();
        session()->regenerateToken();

        $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        $asociado = Auth::guard('asociado')->user()->load(['provincia', 'canton', 'pagos' => fn ($q) => $q->orderByDesc('pagado_en')]);

        return view('livewire.asociados.perfil', compact('asociado'));
    }
}
