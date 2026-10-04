<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" style="color: var(--t-texto);">Galería</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">Galería fotográfica</h1>
        </div>
    </div>

    <section class="py-14" style="background-color: var(--t-fondo);" aria-label="Álbumes fotográficos">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($albumes->isEmpty())
            <p class="text-center py-16" style="color:var(--t-texto-suave);">No hay álbumes publicados todavía.</p>
            @else
            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" role="list">
                @foreach($albumes as $album)
                <li>
                    <a
                        href="{{ route('galeria.album', $album->slug) }}"
                        class="tarjeta-contenido group block"
                        aria-label="{{ $album->titulo }}, álbum del año {{ $album->anio }}"
                    >
                        <div class="aspect-video overflow-hidden">
                            <img
                                src="{{ asset('storage/' . $album->portada) }}"
                                alt="{{ $album->titulo }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                        <div class="tarjeta-cuerpo">
                            <span class="tarjeta-fecha">{{ $album->anio }}</span>
                            <p class="tarjeta-titulo mt-1">{{ $album->titulo }}</p>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
            @endif

        </div>
    </section>

</div>
