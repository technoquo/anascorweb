<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Eventos — ANASCOR')]
#[Layout('layouts.public.base')]
class Eventos extends Component
{
    public function render()
    {
        return view('livewire.eventos', [
            'proximos' => Evento::where('activo', true)
                ->where('inicia_en', '>=', now())
                ->orderBy('inicia_en')
                ->get(),
            'pasados' => Evento::where('activo', true)
                ->where('inicia_en', '<', now())
                ->orderByDesc('inicia_en')
                ->get(),
        ]);
    }
}
