<?php

namespace App\Livewire\Anascor;

use App\Models\Pagina;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Estructura Administración — ANASCOR')]
#[Layout('layouts.public.base')]
class Estructura extends Component
{
    public function render()
    {
        return view('livewire.anascor.estructura', [
            'pagina' => Pagina::where('clave', 'estructura')->first(),
        ]);
    }
}
