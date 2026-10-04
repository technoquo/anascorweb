<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" style="color: var(--t-texto);">Convenios</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">Convenio con Hellen AI y SignBridge</h1>
        </div>
    </div>

    <section class="py-14" style="background-color: var(--t-fondo);" aria-label="Listado de convenios">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($convenios->isEmpty())
            <p class="text-center py-16" style="color:var(--t-texto-suave);">No hay convenios publicados actualmente.</p>
            @else
            <div class="space-y-6">
                @foreach($convenios as $convenio)
                <article class="tarjeta-convenio">
                    <div class="tarjeta-convenio-logo">
                        <img
                            src="{{ asset('storage/' . $convenio->imagen) }}"
                            alt="{{ $convenio->nombre }}"
                            class="max-h-20 max-w-full object-contain"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <div class="flex-1 min-w-0">
                        <h2 class="text-lg font-semibold mb-2" style="color:var(--t-texto);">{{ $convenio->nombre }}</h2>
                        <p class="text-sm leading-relaxed mb-4" style="color:var(--t-texto-suave);">{{ $convenio->descripcion }}</p>
                        @if($convenio->url)
                        <a
                            href="{{ $convenio->url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn-secundario"
                            aria-label="Visitar sitio de {{ $convenio->nombre }} (abre en nueva pestaña)"
                        >
                            Visitar sitio
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                </article>
                @endforeach
            </div>
            @endif

        </div>
    </section>

</div>
