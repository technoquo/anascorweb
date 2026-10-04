<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" style="color: var(--t-texto);">¿Qué es la ANASCOR?</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">¿Qué es la ANASCOR?</h1>
        </div>
    </div>

    @if($pagina)
    <section class="py-14" style="background-color: var(--t-fondo);">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="contenido-html">
                {!! $pagina->contenido !!}
            </div>
        </div>
    </section>
    @endif

    @if($miembros->isNotEmpty())
    <section class="py-14" style="background-color: var(--t-fondo-alt);" aria-labelledby="junta-titulo">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="seccion-subtitulo">Junta directiva</p>
            <h2 id="junta-titulo" class="seccion-titulo mb-10">Quiénes nos dirigen</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach($miembros as $miembro)
                <div class="text-center">
                    <div class="mx-auto mb-3 rounded-full overflow-hidden" style="width:8rem;height:8rem;background-color:var(--t-borde);">
                        <img
                            src="{{ asset('storage/' . $miembro->foto) }}"
                            alt="{{ $miembro->nombre }}"
                            class="w-full h-full object-cover"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <p class="font-semibold text-sm" style="color:var(--t-texto);">{{ $miembro->nombre }}</p>
                    <p class="text-xs mt-0.5" style="color:var(--t-texto-suave);">{{ $miembro->puesto }}</p>
                    @if($miembro->periodo)
                    <p class="text-xs mt-0.5" style="color:var(--t-texto-suave);">{{ $miembro->periodo }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</div>
