<div>

    {{-- Imagen principal --}}
    <div class="w-full overflow-hidden" style="max-height: 28rem; background-color: var(--t-fondo-alt);">
        <img
            src="{{ asset('storage/' . $noticia->imagen) }}"
            alt="{{ $noticia->alt }}"
            class="w-full h-full object-cover"
            style="max-height: 28rem;"
            loading="eager"
            decoding="async"
        >
    </div>

    {{-- Contenido --}}
    <article class="max-w-3xl mx-auto px-4 sm:px-6 py-12">

        {{-- Breadcrumb --}}
        <nav aria-label="Ruta de navegación" class="mb-6">
            <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                <li aria-hidden="true">/</li>
                <li><a href="{{ route('noticias') }}" class="breadcrumb-link">Noticias</a></li>
                <li aria-hidden="true">/</li>
                <li aria-current="page" class="truncate max-w-xs" style="color: var(--t-texto);">{{ $noticia->titulo }}</li>
            </ol>
        </nav>

        {{-- Fecha --}}
        <time class="articulo-fecha" datetime="{{ $noticia->publicado_en->toDateString() }}">
            {{ $noticia->publicado_en->translatedFormat('l, j \d\e F \d\e Y') }}
        </time>

        {{-- Título --}}
        <h1 class="articulo-titulo mt-2 mb-8">{{ $noticia->titulo }}</h1>

        {{-- Cuerpo --}}
        <div class="contenido-html">
            {!! $noticia->contenido !!}
        </div>

        {{-- Video de YouTube --}}
        @if($youtubeId)
        <div class="mt-10">
            <div class="youtube-wrapper">
                <iframe
                    src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                    title="{{ $noticia->titulo }}"
                    allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"
                    class="absolute inset-0 w-full h-full rounded-lg"
                ></iframe>
            </div>
        </div>
        @endif

        {{-- Galería --}}
        @if($noticia->imagenes->isNotEmpty())
        <div class="mt-10">
            <h2 class="text-xl font-semibold mb-4" style="color: var(--t-texto);">Galería</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                @foreach($noticia->imagenes as $imagen)
                <div class="overflow-hidden rounded-lg aspect-square" style="background-color: var(--t-fondo-alt);">
                    <img
                        src="{{ asset('storage/' . $imagen->imagen) }}"
                        alt="{{ $imagen->alt }}"
                        class="w-full h-full object-cover"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Volver --}}
        <div class="mt-12 pt-8 border-t" style="border-color: var(--t-borde);">
            <a href="{{ route('noticias') }}" class="btn-volver">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver a noticias
            </a>
        </div>

    </article>

</div>
