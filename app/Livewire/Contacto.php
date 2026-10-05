<?php

namespace App\Livewire;

use App\Models\Ajuste;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Contacto — ANASCOR')]
#[Layout('layouts.public.base')]
class Contacto extends Component
{
    public function render()
    {
        return view('livewire.contacto', [
            'direccion' => Ajuste::get('direccion'),
            'correo' => Ajuste::get('correo'),
            'facebook' => Ajuste::get('facebook'),
            'instagram' => Ajuste::get('instagram'),
            'tiktok' => Ajuste::get('tiktok'),
            'mapaUrl' => Ajuste::get('mapa_embed_url'),
        ]);
    }
}
