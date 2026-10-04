<div>

    {{-- Cabecera con fecha destacada --}}
    <div style="background-color: var(--t-fondo-alt);">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 py-12">

            <nav aria-label="Ruta de navegación" class="mb-6">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li><a href="{{ route('eventos') }}" class="breadcrumb-link">Eventos</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" class="truncate max-w-xs" style="color: var(--t-texto);">{{ $evento->nombre }}</li>
                </ol>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-start gap-6">

                {{-- Bloque fecha --}}
                <div class="evento-detalle-fecha shrink-0" aria-hidden="true">
                    <span class="evento-detalle-dia">{{ $evento->inicia_en->format('d') }}</span>
                    <span class="evento-detalle-mes">{{ mb_strtoupper($evento->inicia_en->translatedFormat('M')) }}</span>
                    <span class="evento-detalle-anio">{{ $evento->inicia_en->format('Y') }}</span>
                </div>

                <div>
                    <h1 class="articulo-titulo">{{ $evento->nombre }}</h1>

                    <dl class="mt-4 space-y-2 text-sm" style="color: var(--t-texto-suave);">
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <dd>
                                <time datetime="{{ $evento->inicia_en->toIso8601String() }}">
                                    {{ $evento->inicia_en->translatedFormat('l, j \d\e F \d\e Y') }}
                                    · {{ $evento->inicia_en->format('g:i a') }}
                                </time>
                                @if($evento->termina_en)
                                – <time datetime="{{ $evento->termina_en->toIso8601String() }}">{{ $evento->termina_en->format('g:i a') }}</time>
                                @endif
                            </dd>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <dd>{{ $evento->lugar }}</dd>
                        </div>
                        @if($evento->comite)
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <dd>Organizado por:
                                <a href="{{ url('/comites/' . $evento->comite->slug) }}" class="breadcrumb-link ml-1">
                                    {{ $evento->comite->nombre }}
                                </a>
                            </dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>

    {{-- Cuerpo del evento --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-12">

        @if($evento->imagen)
        <div class="mb-10 overflow-hidden rounded-xl" style="max-height: 22rem;">
            <img
                src="{{ asset('storage/' . $evento->imagen) }}"
                alt="{{ $evento->nombre }}"
                class="w-full h-full object-cover"
                style="max-height: 22rem;"
                loading="lazy"
                decoding="async"
            >
        </div>
        @endif

        <div class="contenido-html">
            {!! nl2br(e($evento->descripcion)) !!}
        </div>

        <div class="mt-12 pt-8 border-t" style="border-color: var(--t-borde);">
            <a href="{{ route('eventos') }}" class="btn-volver">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver a eventos
            </a>
        </div>

    </div>

</div>
