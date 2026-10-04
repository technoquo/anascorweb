<?php

namespace App\Livewire\Anascor;

use App\Models\Convenio;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Convenios — ANASCOR')]
#[Layout('layouts.public.base')]
class Convenios extends Component
{
    public function render()
    {
        return view('livewire.anascor.convenios', [
            'convenios' => Convenio::where('status', 1)->orderBy('orden')->get(),
        ]);
    }
}
