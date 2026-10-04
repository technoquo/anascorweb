<?php

namespace App\Livewire\Anascor;

use App\Models\Ajuste;
use App\Models\Pagina;
use App\Models\Valor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Nuestro Trabajo — ANASCOR')]
#[Layout('layouts.public.base')]
class NuestroTrabajo extends Component
{
    public function render()
    {
        return view('livewire.anascor.nuestro-trabajo', [
            'mision' => Pagina::where('clave', 'mision')->first(),
            'vision' => Pagina::where('clave', 'vision')->first(),
            'valores' => Valor::where('activo', true)->orderBy('orden')->get(),
            'personasSordas' => Ajuste::get('personas_sordas'),
            'fuentePersonasSordas' => Ajuste::get('fuente_personas_sordas'),
        ]);
    }
}
