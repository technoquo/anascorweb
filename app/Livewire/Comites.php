<?php

namespace App\Livewire;

use App\Models\Comite;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Comités — ANASCOR')]
#[Layout('layouts.public.base')]
class Comites extends Component
{
    public function render()
    {
        return view('livewire.comites', [
            'comites' => Comite::where('activo', true)->orderBy('orden')->get(),
        ]);
    }
}
