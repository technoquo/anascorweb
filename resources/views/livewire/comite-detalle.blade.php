<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li><a href="{{ route('comites') }}" class="breadcrumb-link">Comités</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" class="truncate max-w-xs" style="color:var(--t-texto);">{{ $comite->nombre }}</li>
                </ol>
            </nav>
            <div class="flex items-center gap-5">
                <img
                    src="{{ asset('storage/' . $comite->logo) }}"
                    alt="{{ $comite->nombre }}"
                    class="h-16 w-16 object-contain"
                    loading="eager"
                    decoding="async"
                >
                <h1 class="pagina-titulo">{{ $comite->nombre }}</h1>
            </div>
        </div>
    </div>

    @if($comite->descripcion)
    <section class="py-12" style="background-color: var(--t-fondo);">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="contenido-html">{!! nl2br(e($comite->descripcion)) !!}</div>
        </div>
    </section>
    @endif

    @if($miembros->isNotEmpty())
    <section class="py-12" style="background-color: var(--t-fondo-alt);" aria-labelledby="miembros-titulo">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 id="miembros-titulo" class="seccion-titulo mb-8">Personas encargadas</h2>
            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" role="list">
                @foreach($miembros as $miembro)
                <li class="text-center">
                    @if($miembro->foto)
                    <div class="mx-auto mb-3 rounded-full overflow-hidden" style="width:7rem;height:7rem;background-color:var(--t-borde);">
                        <img
                            src="{{ asset('storage/' . $miembro->foto) }}"
                            alt="{{ $miembro->nombre }}"
                            class="w-full h-full object-cover"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    @else
                    <div class="mx-auto mb-3 rounded-full flex items-center justify-center" style="width:7rem;height:7rem;background-color:var(--t-borde);">
                        <svg class="w-10 h-10" style="color:var(--t-texto-suave);" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    @endif
                    <p class="font-semibold text-sm" style="color:var(--t-texto);">{{ $miembro->nombre }}</p>
                    <p class="text-xs mt-0.5" style="color:var(--anascor-azul);">{{ $miembro->cargo }}</p>
                    @if($miembro->descripcion)
                    <p class="text-xs mt-1 leading-relaxed" style="color:var(--t-texto-suave);">{{ $miembro->descripcion }}</p>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    @endif

    @if($eventos->isNotEmpty())
    <section class="py-12" style="background-color: var(--t-fondo);" aria-labelledby="eventos-comite-titulo">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 id="eventos-comite-titulo" class="seccion-titulo mb-8">Próximos eventos</h2>
            <div class="space-y-3">
                @foreach($eventos as $evento)
                <a href="{{ route('eventos.detalle', $evento->slug) }}" class="tarjeta-evento">
                    <div class="tarjeta-evento-fecha">
                        <span class="tarjeta-evento-dia">{{ $evento->inicia_en->format('d') }}</span>
                        <span class="tarjeta-evento-mes">{{ strtoupper($evento->inicia_en->translatedFormat('M')) }}</span>
                    </div>
                    <div class="tarjeta-evento-info">
                        <p class="tarjeta-evento-nombre">{{ $evento->nombre }}</p>
                        <p class="tarjeta-evento-lugar">
                            <svg class="w-3.5 h-3.5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $evento->lugar }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('comites') }}" class="btn-volver">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Volver a comités
        </a>
    </div>

</div>
