<?php

namespace App\Livewire\Anascor;

use App\Models\Academia;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Academias de LESCO — ANASCOR')]
#[Layout('layouts.public.base')]
class Academias extends Component
{
    public function render()
    {
        return view('livewire.anascor.academias', [
            'academias' => Academia::where('status', 1)->orderBy('orden')->get(),
        ]);
    }
}
