<div>

{{-- =====================================================
     CARRUSEL
     ===================================================== --}}
@if($slides->isNotEmpty())
<section
    aria-label="Carrusel de imágenes"
    aria-roledescription="carrusel"
    x-data="{
        actual: 0,
        total: {{ $slides->count() }},
        pausado: false,
        intervalId: null,
        init() {
            if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                this.intervalId = setInterval(() => {
                    if (!this.pausado) this.siguiente();
                }, 5000);
            }
        },
        siguiente() { this.actual = (this.actual + 1) % this.total; },
        anterior()  { this.actual = (this.actual - 1 + this.total) % this.total; },
        irA(n)      { this.actual = n; }
    }"
    @mouseenter="pausado = true"
    @mouseleave="pausado = false"
    @focusin="pausado  = true"
    @focusout="pausado = false"
    class="carrusel-wrapper relative overflow-hidden"
    style="height: 28rem;"
>
    {{-- Slides --}}
    @foreach($slides as $idx => $slide)
    <div
        class="absolute inset-0 carrusel-slide transition-opacity duration-700"
        :class="actual === {{ $idx }} ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none'"
        role="group"
        aria-roledescription="diapositiva"
        aria-label="Diapositiva {{ $idx + 1 }} de {{ $slides->count() }}"
    >
        @if($slide->enlace)
        <a href="{{ $slide->enlace }}" tabindex="-1" aria-label="{{ $slide->alt }}">
        @endif
            <img
                src="{{ asset('storage/' . $slide->imagen) }}"
                alt="{{ $slide->alt }}"
                class="w-full h-full object-cover"
                loading="{{ $idx === 0 ? 'eager' : 'lazy' }}"
                decoding="async"
            >
        @if($slide->enlace)
        </a>
        @endif

        @if($slide->titulo)
        <div class="absolute bottom-0 left-0 right-0 carrusel-overlay px-6 py-8">
            <div class="max-w-7xl mx-auto">
                @if($slide->enlace)
                <a href="{{ $slide->enlace }}" class="carrusel-titulo-link">
                    <h2 class="carrusel-titulo">{{ $slide->titulo }}</h2>
                </a>
                @else
                <p class="carrusel-titulo">{{ $slide->titulo }}</p>
                @endif
            </div>
        </div>
        @endif
    </div>
    @endforeach

    {{-- Flecha anterior --}}
    <button
        type="button"
        class="carrusel-flecha carrusel-flecha--izq"
        @click="anterior()"
        aria-label="Diapositiva anterior"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    {{-- Flecha siguiente --}}
    <button
        type="button"
        class="carrusel-flecha carrusel-flecha--der"
        @click="siguiente()"
        aria-label="Diapositiva siguiente"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- Barra inferior: dots + pausa --}}
    <div class="absolute bottom-3 left-0 right-0 z-20 flex items-center justify-center gap-3" aria-label="Controles del carrusel">

        {{-- Dots --}}
        <div role="tablist" aria-label="Seleccionar diapositiva" class="flex items-center gap-2">
            @foreach($slides as $idx => $slide)
            <button
                type="button"
                role="tab"
                :aria-selected="actual === {{ $idx }} ? 'true' : 'false'"
                :aria-label="'Ir a diapositiva ' + {{ $idx + 1 }}"
                @click="irA({{ $idx }})"
                class="carrusel-dot"
                :class="actual === {{ $idx }} ? 'carrusel-dot--activo' : ''"
            ></button>
            @endforeach
        </div>

        {{-- Botón pausa --}}
        <button
            type="button"
            @click="pausado = !pausado"
            :aria-label="pausado ? 'Reanudar carrusel' : 'Pausar carrusel'"
            :aria-pressed="pausado.toString()"
            class="carrusel-pausa"
        >
            <template x-if="!pausado">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/>
                </svg>
            </template>
            <template x-if="pausado">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <polygon points="5,3 19,12 5,21"/>
                </svg>
            </template>
        </button>
    </div>
</section>
@endif

{{-- =====================================================
     NOTICIAS RECIENTES
     ===================================================== --}}
@if($noticias->isNotEmpty())
<section class="py-16" style="background-color: var(--t-fondo-alt);" aria-labelledby="titulo-noticias">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-end justify-between mb-10">
            <div>
                <p class="seccion-subtitulo">Lo que acontece</p>
                <h2 id="titulo-noticias" class="seccion-titulo">Noticias recientes</h2>
            </div>
            <a href="{{ route('noticias') }}" class="btn-secundario">
                Más noticias
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($noticias as $noticia)
            <article class="tarjeta-contenido group">
                <a
                    href="{{ route('noticias.detalle', $noticia->slug) }}"
                    class="block aspect-video overflow-hidden"
                    tabindex="-1"
                    aria-hidden="true"
                >
                    <img
                        src="{{ asset('storage/' . $noticia->imagen) }}"
                        alt="{{ $noticia->alt }}"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                        loading="lazy"
                        decoding="async"
                    >
                </a>
                <div class="tarjeta-cuerpo">
                    <time
                        class="tarjeta-fecha"
                        datetime="{{ $noticia->publicado_en->toDateString() }}"
                    >
                        {{ $noticia->publicado_en->translatedFormat('j \d\e F, Y') }}
                    </time>
                    <h3 class="tarjeta-titulo mt-1">
                        <a href="{{ route('noticias.detalle', $noticia->slug) }}" class="tarjeta-titulo-link">
                            {{ $noticia->titulo }}
                        </a>
                    </h3>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =====================================================
     EVENTOS PRÓXIMOS
     ===================================================== --}}
@if($eventos->isNotEmpty())
<section class="py-16" style="background-color: var(--t-fondo);" aria-labelledby="titulo-eventos">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-end justify-between mb-10">
            <div>
                <p class="seccion-subtitulo">Próximas actividades</p>
                <h2 id="titulo-eventos" class="seccion-titulo">Eventos</h2>
            </div>
            <a href="{{ route('eventos') }}" class="btn-secundario">
                Ver todos
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($eventos as $evento)
            <a
                href="{{ route('eventos.detalle', $evento->slug) }}"
                class="tarjeta-evento group"
                aria-label="{{ $evento->nombre }}, {{ $evento->inicia_en->translatedFormat('j \d\e F') }}"
            >
                <div class="tarjeta-evento-fecha" aria-hidden="true">
                    <span class="tarjeta-evento-dia">{{ $evento->inicia_en->format('d') }}</span>
                    <span class="tarjeta-evento-mes">{{ mb_strtoupper($evento->inicia_en->translatedFormat('M')) }}</span>
                </div>
                <div class="tarjeta-evento-info">
                    <h3 class="tarjeta-evento-nombre group-hover:underline">{{ $evento->nombre }}</h3>
                    <p class="tarjeta-evento-lugar">
                        <svg class="w-3.5 h-3.5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ Str::limit($evento->lugar, 50) }}
                    </p>
                    <p class="tarjeta-evento-hora">
                        {{ $evento->inicia_en->format('g:i a') }}
                        @if($evento->termina_en)
                        – {{ $evento->termina_en->format('g:i a') }}
                        @endif
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

</div>
