<?php

namespace App\Livewire;

use App\Models\Comite;
use App\Models\Evento;
use Livewire\Component;

class ComiteDetalle extends Component
{
    public Comite $comite;

    public function mount(string $slug): void
    {
        $this->comite = Comite::where('slug', $slug)->where('activo', true)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.comite-detalle', [
            'miembros' => $this->comite->miembros()->orderBy('orden')->get(),
            'eventos' => Evento::where('comite_id', $this->comite->id)
                ->where('activo', true)
                ->where('inicia_en', '>=', now())
                ->orderBy('inicia_en')
                ->limit(6)
                ->get(),
        ])->layout('layouts.public.base', [
            'title' => $this->comite->nombre.' — ANASCOR',
        ]);
    }
}
