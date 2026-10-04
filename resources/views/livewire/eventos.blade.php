<div>

    {{-- Encabezado de página --}}
    <div style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" style="color: var(--t-texto);">Eventos</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">Eventos</h1>
        </div>
    </div>

    <div class="py-14" style="background-color: var(--t-fondo);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            {{-- Próximos --}}
            <section aria-labelledby="titulo-proximos">
                <h2 id="titulo-proximos" class="seccion-titulo mb-8">Próximos eventos</h2>

                @if($proximos->isEmpty())
                <p style="color: var(--t-texto-suave);">No hay eventos próximos en este momento.</p>
                @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($proximos as $evento)
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
                                {{ Str::limit($evento->lugar, 55) }}
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
                @endif
            </section>

            {{-- Pasados --}}
            @if($pasados->isNotEmpty())
            <section aria-labelledby="titulo-pasados">
                <h2 id="titulo-pasados" class="seccion-titulo mb-8" style="color: var(--t-texto-suave);">Eventos anteriores</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 opacity-70">
                    @foreach($pasados as $evento)
                    <a
                        href="{{ route('eventos.detalle', $evento->slug) }}"
                        class="tarjeta-evento group"
                        aria-label="{{ $evento->nombre }}, {{ $evento->inicia_en->translatedFormat('j \d\e F') }}"
                    >
                        <div class="tarjeta-evento-fecha tarjeta-evento-fecha--pasado" aria-hidden="true">
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
                                {{ Str::limit($evento->lugar, 55) }}
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </section>
            @endif

        </div>
    </div>

</div>
