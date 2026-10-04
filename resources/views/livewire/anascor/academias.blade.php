<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" style="color: var(--t-texto);">Academias de LESCO</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">Convenio con las academias de LESCO</h1>
        </div>
    </div>

    <section class="py-14" style="background-color: var(--t-fondo);" aria-label="Listado de academias de LESCO">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($academias->isEmpty())
            <p class="text-center py-16" style="color:var(--t-texto-suave);">No hay academias publicadas actualmente.</p>
            @else
            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6" role="list">
                @foreach($academias as $academia)
                <li>
                    <a
                        href="{{ $academia->url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="tarjeta-academia group"
                        aria-label="{{ $academia->nombre }} (abre en nueva pestaña)"
                    >
                        <div class="tarjeta-academia-logo">
                            <img
                                src="{{ asset('storage/' . $academia->imagen) }}"
                                alt="{{ $academia->nombre }}"
                                class="max-h-16 max-w-full object-contain"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                        <div class="px-5 py-4">
                            <p class="font-semibold" style="color:var(--t-texto);">{{ $academia->nombre }}</p>
                            <p class="text-sm mt-1 flex items-center gap-1" style="color:var(--t-enlace);">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Visitar sitio
                            </p>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
            @endif

        </div>
    </section>

</div>
