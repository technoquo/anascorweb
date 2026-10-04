<div>

    {{-- Encabezado de página --}}
    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" style="color: var(--t-texto);">Noticias</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">Noticias</h1>
        </div>
    </div>

    {{-- Cuadrícula --}}
    <section class="py-14" style="background-color: var(--t-fondo);" aria-label="Listado de noticias">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($noticias->isEmpty())
            <p class="text-center py-16" style="color: var(--t-texto-suave);">No hay noticias publicadas todavía.</p>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
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
                        <time class="tarjeta-fecha" datetime="{{ $noticia->publicado_en->toDateString() }}">
                            {{ $noticia->publicado_en->translatedFormat('j \d\e F, Y') }}
                        </time>
                        <h2 class="tarjeta-titulo mt-1">
                            <a href="{{ route('noticias.detalle', $noticia->slug) }}" class="tarjeta-titulo-link">
                                {{ $noticia->titulo }}
                            </a>
                        </h2>
                    </div>
                </article>
                @endforeach
            </div>

            {{-- Paginación --}}
            @if($noticias->hasPages())
            <div class="mt-12 flex justify-center" aria-label="Paginación">
                {{ $noticias->links() }}
            </div>
            @endif
            @endif

        </div>
    </section>

</div>
