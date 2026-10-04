<?php

namespace App\Livewire;

use App\Models\Album;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Galería — ANASCOR')]
#[Layout('layouts.public.base')]
class Galeria extends Component
{
    public function render()
    {
        return view('livewire.galeria', [
            'albumes' => Album::where('activo', true)->orderByDesc('anio')->get(),
        ]);
    }
}
