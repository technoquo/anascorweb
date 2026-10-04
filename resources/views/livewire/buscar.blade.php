<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="pagina-titulo">Resultados de búsqueda</h1>
            @if($q)
            <p class="mt-2 text-sm" style="color:var(--t-texto-suave);">
                @if($resultados->isNotEmpty())
                    {{ $resultados->count() }} {{ $resultados->count() === 1 ? 'resultado' : 'resultados' }} para «{{ $q }}»
                @else
                    Sin resultados para «{{ $q }}»
                @endif
            </p>
            @endif
        </div>
    </div>

    <section class="py-14" style="background-color: var(--t-fondo);">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Campo de búsqueda --}}
            <form action="{{ route('buscar') }}" method="GET" role="search" class="mb-10">
                <label for="buscar-q" class="sr-only">Buscar en el sitio</label>
                <div class="flex">
                    <input
                        type="search"
                        id="buscar-q"
                        name="q"
                        value="{{ $q }}"
                        placeholder="Buscar en el sitio…"
                        class="public-search-input flex-1"
                        style="border-radius:0.375rem 0 0 0.375rem;border-right:none;"
                        autofocus
                    >
                    <button type="submit" class="public-search-btn" aria-label="Buscar">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </form>

            @if(!$q)
            <p class="text-center py-10" style="color:var(--t-texto-suave);">Escriba una palabra clave para buscar en noticias, eventos, comités y páginas.</p>

            @elseif($resultados->isEmpty())
            <div class="text-center py-10">
                <svg class="w-12 h-12 mx-auto mb-4" style="color:var(--t-texto-suave);" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="font-semibold" style="color:var(--t-texto);">No se encontraron resultados</p>
                <p class="text-sm mt-1" style="color:var(--t-texto-suave);">Intente con otras palabras clave.</p>
            </div>

            @else
            <ul class="space-y-4" role="list" aria-label="Resultados de búsqueda">
                @foreach($resultados as $item)
                <li>
                    <a href="{{ $item['url'] }}" class="resultado-buscar group">
                        <div class="flex items-start gap-4">
                            <span class="resultado-tipo flex-shrink-0">{{ $item['tipo'] }}</span>
                            <div class="flex-1 min-w-0">
                                <p class="resultado-titulo group-hover:underline">{{ $item['titulo'] }}</p>
                                @if($item['extracto'])
                                <p class="resultado-extracto mt-1">{{ Str::limit($item['extracto'], 140) }}</p>
                                @endif
                                @if($item['fecha'])
                                <p class="resultado-fecha mt-1">{{ $item['fecha'] }}</p>
                                @endif
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
            @endif

        </div>
    </section>

</div>
