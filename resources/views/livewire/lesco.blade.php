<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" style="color: var(--t-texto);">LESCO</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">LESCO — Lengua de Señas Costarricense</h1>
        </div>
    </div>

    @if($pagina)
    <section class="py-14" style="background-color: var(--t-fondo);" aria-labelledby="lesco-que-es">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="seccion-subtitulo">¿Qué es la LESCO?</p>
            <h2 id="lesco-que-es" class="seccion-titulo mb-6">{{ $pagina->titulo }}</h2>
            <div class="contenido-html">{!! $pagina->contenido !!}</div>

            @if($pagina->video_url)
            @php
                preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([A-Za-z0-9_\-]{11})/', $pagina->video_url, $m);
                $videoId = $m[1] ?? null;
            @endphp
            @if($videoId)
            <div class="mt-10 youtube-wrapper">
                <iframe
                    src="https://www.youtube-nocookie.com/embed/{{ $videoId }}"
                    title="{{ $pagina->titulo }}"
                    allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"
                    class="absolute inset-0 w-full h-full rounded-lg"
                ></iframe>
            </div>
            @endif
            @endif
        </div>
    </section>
    @endif

    @if($secciones->isNotEmpty())
    <section class="py-14" style="background-color: var(--t-fondo-alt);" aria-label="Secciones de LESCO">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div
                x-data="{ abierto: '{{ $secciones->first()->slug }}' }"
                class="space-y-2"
            >
                @foreach($secciones as $seccion)
                <div class="acord-item" style="border:1px solid var(--t-borde);">
                    <h3>
                        <button
                            @click="abierto = abierto === '{{ $seccion->slug }}' ? '' : '{{ $seccion->slug }}'"
                            :aria-expanded="abierto === '{{ $seccion->slug }}'"
                            aria-controls="acord-{{ $seccion->slug }}"
                            class="acord-boton"
                            type="button"
                        >
                            <span>{{ $seccion->titulo }}</span>
                            <svg
                                class="w-5 h-5 flex-shrink-0 transition-transform duration-200"
                                :class="{ 'rotate-180': abierto === '{{ $seccion->slug }}' }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </h3>
                    <div
                        id="acord-{{ $seccion->slug }}"
                        x-show="abierto === '{{ $seccion->slug }}'"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-cloak
                        class="px-5 pb-5"
                    >
                        <p class="text-sm leading-relaxed" style="color:var(--t-texto-suave);">{{ $seccion->descripcion }}</p>

                        @if($seccion->video_url)
                        @php
                            preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([A-Za-z0-9_\-]{11})/', $seccion->video_url, $m);
                            $vid = $m[1] ?? null;
                        @endphp
                        @if($vid)
                        <div class="mt-4 youtube-wrapper">
                            <iframe
                                src="https://www.youtube-nocookie.com/embed/{{ $vid }}"
                                title="{{ $seccion->titulo }}"
                                allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                loading="lazy"
                                class="absolute inset-0 w-full h-full rounded-lg"
                            ></iframe>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
    @endif

</div>
