<?php

namespace App\Livewire;

use App\Models\Album;
use Livewire\Component;
use Livewire\WithPagination;

class AlbumDetalle extends Component
{
    use WithPagination;

    public Album $album;

    public function mount(string $slug): void
    {
        $this->album = Album::where('slug', $slug)->where('activo', true)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.album-detalle', [
            'fotos' => $this->album->fotos()->orderBy('orden')->paginate(20),
        ])->layout('layouts.public.base', [
            'title' => $this->album->titulo.' — Galería — ANASCOR',
        ]);
    }
}
