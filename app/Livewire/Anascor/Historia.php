<?php

namespace App\Livewire\Anascor;

use App\Models\HitoHistoria;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Historia de las Asociaciones — ANASCOR')]
#[Layout('layouts.public.base')]
class Historia extends Component
{
    public function render()
    {
        return view('livewire.anascor.historia', [
            'hitos' => HitoHistoria::orderBy('anio')->orderBy('orden')->get(),
        ]);
    }
}
