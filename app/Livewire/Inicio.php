<?php

namespace App\Livewire;

use App\Models\Evento;
use App\Models\Noticia;
use App\Models\Slide;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('ANASCOR — Asociación Nacional de Sordos de Costa Rica')]
#[Layout('layouts.public.base')]
class Inicio extends Component
{
    public function render()
    {
        return view('livewire.inicio', [
            'slides' => Slide::where('activo', true)->orderBy('orden')->get(),
            'noticias' => Noticia::where('activo', true)->orderByDesc('publicado_en')->limit(4)->get(),
            'eventos' => Evento::where('activo', true)->where('inicia_en', '>=', now())->orderBy('inicia_en')->limit(6)->get(),
        ]);
    }
}
