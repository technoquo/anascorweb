<?php

namespace App\Livewire\Anascor;

use App\Models\Expresidente;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Ex-presidentes — ANASCOR')]
#[Layout('layouts.public.base')]
class Expresidentes extends Component
{
    public function render()
    {
        return view('livewire.anascor.expresidentes', [
            'expresidentes' => Expresidente::orderBy('orden')->get(),
        ]);
    }
}
