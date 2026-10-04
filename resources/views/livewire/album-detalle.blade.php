<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li><a href="{{ route('galeria') }}" class="breadcrumb-link">Galería</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" class="truncate max-w-xs" style="color: var(--t-texto);">{{ $album->titulo }}</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">{{ $album->titulo }}</h1>
            <p class="mt-1 text-sm" style="color:var(--t-texto-suave);">
                {{ $album->anio }}
                @if($album->descripcion) · {{ $album->descripcion }} @endif
                · {{ $fotos->total() }} {{ $fotos->total() === 1 ? 'foto' : 'fotos' }}
            </p>
        </div>
    </div>

    {{-- Cuadrícula de fotos: x-data mínimo aquí para poder usar $store en los botones --}}
    <section x-data style="background-color: var(--t-fondo);" class="py-10" aria-label="Fotos del álbum">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($fotos->isEmpty())
            <p class="text-center py-16" style="color:var(--t-texto-suave);">Este álbum aún no tiene fotos.</p>
            @else

            <ul class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2" role="list">
                @foreach($fotos as $foto)
                <li>
                    <button
                        @click="$store.lb.abrir(
                            [...document.querySelectorAll('[data-foto-src]')].map(el => ({
                                src: el.getAttribute('data-foto-src'),
                                alt: el.getAttribute('data-foto-alt')
                            })),
                            {{ $loop->index }}
                        )"
                        data-foto-src="{{ asset('storage/' . $foto->imagen) }}"
                        data-foto-alt="{{ $foto->alt }}"
                        type="button"
                        class="foto-thumb group w-full"
                        aria-label="Ver foto: {{ $foto->alt }}"
                    >
                        <img
                            src="{{ asset('storage/' . $foto->imagen) }}"
                            alt="{{ $foto->alt }}"
                            class="w-full h-full object-cover"
                            loading="lazy"
                            decoding="async"
                        >
                    </button>
                </li>
                @endforeach
            </ul>

            {{-- Paginación Anterior / Siguiente --}}
            @if($fotos->hasPages())
            <div class="mt-10 flex items-center justify-center gap-4" aria-label="Paginación de fotos">
                <button
                    wire:click="previousPage"
                    class="btn-paginacion"
                    {{ $fotos->onFirstPage() ? 'disabled' : '' }}
                    aria-label="Página anterior"
                    type="button"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Anterior
                </button>

                <span class="text-sm tabular-nums" style="color:var(--t-texto-suave);">
                    {{ $fotos->currentPage() }} / {{ $fotos->lastPage() }}
                </span>

                <button
                    wire:click="nextPage"
                    class="btn-paginacion"
                    {{ $fotos->hasMorePages() ? '' : 'disabled' }}
                    aria-label="Página siguiente"
                    type="button"
                >
                    Siguiente
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
            @endif

            @endif

        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
        <a href="{{ route('galeria') }}" class="btn-volver">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Volver a la galería
        </a>
    </div>

    {{--
        Lightbox: wire:ignore evita que Livewire lo toque al paginar.
        Lee su estado desde Alpine.store('lb'), que sobrevive al morph.
        El teclado (←, →, Esc) se maneja en app.js con document.addEventListener.
    --}}
    <div wire:ignore>
        <div
            x-data
            x-show="$store.lb.open"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click.self="$store.lb.cerrar()"
            class="lightbox-overlay"
            role="dialog"
            aria-modal="true"
            aria-label="Visor de fotos"
            x-cloak
        >
            <button @click="$store.lb.cerrar()" type="button" class="lightbox-cerrar" aria-label="Cerrar visor">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <button @click="$store.lb.anterior()" type="button" class="lightbox-nav lightbox-nav--izq" aria-label="Foto anterior">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <div class="lightbox-imagen-wrapper">
                <img
                    :src="$store.lb.fotos[$store.lb.indice]?.src"
                    :alt="$store.lb.fotos[$store.lb.indice]?.alt"
                    class="lightbox-imagen"
                >
                <p class="lightbox-alt" x-text="$store.lb.fotos[$store.lb.indice]?.alt"></p>
                <p
                    class="lightbox-contador"
                    x-text="($store.lb.indice + 1) + ' / ' + $store.lb.fotos.length"
                    aria-live="polite"
                ></p>
            </div>

            <button @click="$store.lb.siguiente()" type="button" class="lightbox-nav lightbox-nav--der" aria-label="Foto siguiente">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>

</div>
