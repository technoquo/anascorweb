<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" style="color: var(--t-texto);">Nuestro Trabajo</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">Nuestro Trabajo</h1>
        </div>
    </div>

    @if($personasSordas)
    <div class="py-10 text-center text-white" style="background-color: var(--anascor-azul);" role="region" aria-label="Dato estadístico">
        <p class="text-4xl font-bold">{{ $personasSordas }}</p>
        @if($fuentePersonasSordas)
        <p class="text-sm mt-2 opacity-85">{{ $fuentePersonasSordas }}</p>
        @endif
    </div>
    @endif

    @if($mision)
    <section class="py-14" style="background-color: var(--t-fondo);" aria-labelledby="mision-titulo">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="seccion-subtitulo">Misión</p>
            <h2 id="mision-titulo" class="seccion-titulo mb-6">{{ $mision->titulo }}</h2>
            <div class="contenido-html">{!! $mision->contenido !!}</div>
        </div>
    </section>
    @endif

    @if($vision)
    <section class="py-14" style="background-color: var(--t-fondo-alt);" aria-labelledby="vision-titulo">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="seccion-subtitulo">Visión</p>
            <h2 id="vision-titulo" class="seccion-titulo mb-6">{{ $vision->titulo }}</h2>
            <div class="contenido-html">{!! $vision->contenido !!}</div>
        </div>
    </section>
    @endif

    @if($valores->isNotEmpty())
    <section class="py-14" style="background-color: var(--t-fondo);" aria-labelledby="valores-titulo">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="seccion-subtitulo">Valores</p>
            <h2 id="valores-titulo" class="seccion-titulo mb-10">Nuestros valores</h2>
            <ul class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" role="list">
                @foreach($valores as $valor)
                <li class="tarjeta-valor">
                    @if($valor->icono)
                    <span class="text-2xl mb-2" aria-hidden="true">{{ $valor->icono }}</span>
                    @endif
                    <p class="font-semibold text-center text-sm" style="color:var(--t-texto);">{{ $valor->nombre }}</p>
                    @if($valor->descripcion)
                    <p class="text-xs text-center mt-1" style="color:var(--t-texto-suave);">{{ $valor->descripcion }}</p>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    @endif

</div>
