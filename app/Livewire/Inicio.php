<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('ANASCOR — Asociación Nacional de Sordos de Costa Rica')]
#[Layout('layouts.public.base')]
class Inicio extends Component
{
    public function render()
    {
        return view('livewire.inicio');
    }
}
