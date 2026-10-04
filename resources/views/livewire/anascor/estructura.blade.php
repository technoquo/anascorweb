<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" style="color: var(--t-texto);">Estructura Administración</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">Estructura Administración de ANASCOR</h1>
        </div>
    </div>

    <section class="py-14" style="background-color: var(--t-fondo);">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($pagina && $pagina->imagen)
            <div
                x-data="{ abierto: false }"
                class="text-center"
            >
                <p class="text-sm mb-4" style="color:var(--t-texto-suave);">
                    Haga clic en el organigrama para verlo en pantalla completa.
                </p>

                <button
                    @click="abierto = true"
                    class="inline-block rounded-xl overflow-hidden border focus-visible:ring-2 focus-visible:ring-[var(--t-enlace)] focus-visible:outline-none"
                    style="border-color:var(--t-borde);"
                    aria-label="Ampliar organigrama de ANASCOR"
                    type="button"
                >
                    <img
                        src="{{ asset('storage/' . $pagina->imagen) }}"
                        alt="{{ $pagina->alt }}"
                        class="max-w-full h-auto"
                        loading="eager"
                        decoding="async"
                    >
                </button>

                {{-- Lightbox --}}
                <div
                    x-show="abierto"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.self="abierto = false"
                    @keydown.escape.window="abierto = false"
                    class="lightbox-overlay"
                    role="dialog"
                    aria-modal="true"
                    aria-label="Organigrama en pantalla completa"
                    x-cloak
                >
                    <button
                        @click="abierto = false"
                        class="lightbox-cerrar"
                        aria-label="Cerrar"
                        type="button"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <div class="lightbox-imagen-wrapper">
                        <img
                            src="{{ asset('storage/' . $pagina->imagen) }}"
                            alt="{{ $pagina->alt }}"
                            class="lightbox-imagen"
                        >
                    </div>
                </div>
            </div>

            @if($pagina->contenido)
            <div class="contenido-html mt-10 max-w-3xl mx-auto">
                {!! $pagina->contenido !!}
            </div>
            @endif

            @else
            <p class="text-center py-16" style="color:var(--t-texto-suave);">El organigrama se publicará próximamente.</p>
            @endif

        </div>
    </section>

</div>
