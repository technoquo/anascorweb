<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Component;

class EventoDetalle extends Component
{
    public Evento $evento;

    public function mount(string $slug): void
    {
        $this->evento = Evento::with('comite')
            ->where('slug', $slug)
            ->where('activo', true)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.evento-detalle')
            ->layout('layouts.public.base', [
                'title' => $this->evento->nombre.' — ANASCOR',
            ]);
    }
}
