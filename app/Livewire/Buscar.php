<?php

namespace App\Livewire;

use App\Models\Comite;
use App\Models\Evento;
use App\Models\Noticia;
use App\Models\Pagina;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Buscar — ANASCOR')]
#[Layout('layouts.public.base')]
class Buscar extends Component
{
    #[Url(as: 'q')]
    public string $q = '';

    public function render()
    {
        return view('livewire.buscar', [
            'resultados' => $this->buscar(),
        ]);
    }

    private function buscar(): Collection
    {
        $termino = trim($this->q);

        if (mb_strlen($termino) < 2) {
            return collect();
        }

        $like = "%{$termino}%";

        $noticias = Noticia::where('activo', true)
            ->where(fn ($q) => $q->where('titulo', 'like', $like)->orWhere('resumen', 'like', $like))
            ->orderByDesc('publicado_en')
            ->limit(10)
            ->get()
            ->map(fn ($n) => [
                'tipo' => 'Noticia',
                'titulo' => $n->titulo,
                'extracto' => $n->resumen,
                'url' => route('noticias.detalle', $n->slug),
                'fecha' => $n->publicado_en->translatedFormat('j \d\e F, Y'),
            ]);

        $eventos = Evento::where('activo', true)
            ->where(fn ($q) => $q->where('nombre', 'like', $like)->orWhere('descripcion', 'like', $like))
            ->orderBy('inicia_en')
            ->limit(10)
            ->get()
            ->map(fn ($e) => [
                'tipo' => 'Evento',
                'titulo' => $e->nombre,
                'extracto' => $e->lugar,
                'url' => route('eventos.detalle', $e->slug),
                'fecha' => $e->inicia_en->translatedFormat('j \d\e F, Y'),
            ]);

        $comites = Comite::where('activo', true)
            ->where(fn ($q) => $q->where('nombre', 'like', $like)->orWhere('descripcion', 'like', $like))
            ->limit(5)
            ->get()
            ->map(fn ($c) => [
                'tipo' => 'Comité',
                'titulo' => $c->nombre,
                'extracto' => $c->descripcion,
                'url' => route('comites.detalle', $c->slug),
                'fecha' => null,
            ]);

        $paginas = Pagina::where(fn ($q) => $q->where('titulo', 'like', $like)->orWhere('contenido', 'like', $like))
            ->limit(5)
            ->get()
            ->map(fn ($p) => [
                'tipo' => 'Página',
                'titulo' => $p->titulo,
                'extracto' => null,
                'url' => $this->urlDePagina($p->clave),
                'fecha' => null,
            ]);

        return $noticias->concat($eventos)->concat($comites)->concat($paginas);
    }

    private function urlDePagina(string $clave): string
    {
        return match ($clave) {
            'quienes-somos' => route('anascor.quienes-somos'),
            'mision', 'vision' => route('anascor.nuestro-trabajo'),
            'estructura' => route('anascor.estructura'),
            'que-es-lesco' => route('lesco'),
            default => route('home'),
        };
    }
}
