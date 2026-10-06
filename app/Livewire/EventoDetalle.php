<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Component;

class EventoDetalle extends Component
{
    public Evento $evento;

    public ?string $youtubeId = null;

    public function mount(string $slug): void
    {
        $this->evento = Evento::with(['comite', 'imagenes'])
            ->where('slug', $slug)
            ->where('activo', true)
            ->firstOrFail();

        if ($this->evento->video_url) {
            preg_match(
                '/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([A-Za-z0-9_\-]{11})/',
                $this->evento->video_url,
                $matches
            );
            $this->youtubeId = $matches[1] ?? null;
        }
    }

    public function render()
    {
        return view('livewire.evento-detalle')
            ->layout('layouts.public.base', [
                'title' => $this->evento->nombre.' — ANASCOR',
            ]);
    }
}
