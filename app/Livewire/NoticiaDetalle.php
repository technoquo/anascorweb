<?php

namespace App\Livewire;

use App\Models\Noticia;
use Livewire\Component;

class NoticiaDetalle extends Component
{
    public Noticia $noticia;

    public ?string $youtubeId = null;

    public function mount(string $slug): void
    {
        $this->noticia = Noticia::with('imagenes')->where('slug', $slug)->where('activo', true)->firstOrFail();

        if ($this->noticia->video_url) {
            preg_match(
                '/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([A-Za-z0-9_\-]{11})/',
                $this->noticia->video_url,
                $matches
            );
            $this->youtubeId = $matches[1] ?? null;
        }
    }

    public function render()
    {
        return view('livewire.noticia-detalle')
            ->layout('layouts.public.base', [
                'title' => $this->noticia->titulo.' — ANASCOR',
            ]);
    }
}
