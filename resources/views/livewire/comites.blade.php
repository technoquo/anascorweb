<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" style="color: var(--t-texto);">Comités</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">Comités</h1>
        </div>
    </div>

    <section class="py-14" style="background-color: var(--t-fondo);" aria-label="Listado de comités">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($comites->isEmpty())
            <p class="text-center py-16" style="color:var(--t-texto-suave);">No hay comités publicados actualmente.</p>
            @else
            <ul class="space-y-4" role="list">
                @foreach($comites as $comite)
                <li>
                    <a
                        href="{{ route('comites.detalle', $comite->slug) }}"
                        class="tarjeta-comite group"
                    >
                        <div class="tarjeta-comite-logo" aria-hidden="true">
                            <img
                                src="{{ asset('storage/' . $comite->logo) }}"
                                alt=""
                                class="max-h-14 max-w-full object-contain"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold group-hover:underline" style="color:var(--t-texto);">{{ $comite->nombre }}</p>
                            @if($comite->descripcion)
                            <p class="text-sm mt-1 line-clamp-2" style="color:var(--t-texto-suave);">{{ $comite->descripcion }}</p>
                            @endif
                        </div>
                        <svg class="w-5 h-5 flex-shrink-0" style="color:var(--t-texto-suave);" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </li>
                @endforeach
            </ul>
            @endif

        </div>
    </section>

</div>
