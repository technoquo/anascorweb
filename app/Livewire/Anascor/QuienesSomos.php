<?php

namespace App\Livewire\Anascor;

use App\Models\MiembroJunta;
use App\Models\Pagina;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('¿Qué es la ANASCOR? — ANASCOR')]
#[Layout('layouts.public.base')]
class QuienesSomos extends Component
{
    public function render()
    {
        return view('livewire.anascor.quienes-somos', [
            'pagina' => Pagina::where('clave', 'quienes-somos')->first(),
            'miembros' => MiembroJunta::where('activo', true)->orderBy('orden')->get(),
        ]);
    }
}
