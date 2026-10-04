<?php

namespace App\Livewire;

use App\Models\Noticia;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Noticias — ANASCOR')]
#[Layout('layouts.public.base')]
class Noticias extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.noticias', [
            'noticias' => Noticia::where('activo', true)
                ->orderByDesc('publicado_en')
                ->paginate(12),
        ]);
    }
}
