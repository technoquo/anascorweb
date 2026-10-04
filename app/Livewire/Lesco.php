<?php

namespace App\Livewire;

use App\Models\LescoSeccion;
use App\Models\Pagina;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('LESCO — ANASCOR')]
#[Layout('layouts.public.base')]
class Lesco extends Component
{
    public function render()
    {
        return view('livewire.lesco', [
            'pagina' => Pagina::where('clave', 'que-es-lesco')->first(),
            'secciones' => LescoSeccion::where('activo', true)->orderBy('orden')->get(),
        ]);
    }
}
