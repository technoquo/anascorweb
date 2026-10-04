<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" style="color: var(--t-texto);">Historia de las Asociaciones</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">Historia de las Asociaciones</h1>
        </div>
    </div>

    <section class="py-14" style="background-color: var(--t-fondo);" aria-label="Línea de tiempo histórica">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($hitos->isEmpty())
            <p class="text-center py-16" style="color:var(--t-texto-suave);">No hay hitos registrados todavía.</p>
            @else
            <ol class="timeline-lista" aria-label="Cronograma histórico">
                @foreach($hitos as $hito)
                <li class="timeline-item">
                    <div class="timeline-anio" aria-label="Año {{ $hito->anio }}">{{ $hito->anio }}</div>
                    <div class="timeline-cuerpo">
                        <h2 class="timeline-titulo">{{ $hito->titulo }}</h2>
                        <p class="timeline-desc">{{ $hito->descripcion }}</p>
                        @if($hito->imagen)
                        <img
                            src="{{ asset('storage/' . $hito->imagen) }}"
                            alt="{{ $hito->alt }}"
                            class="mt-4 rounded-lg w-full max-w-md"
                            loading="lazy"
                            decoding="async"
                        >
                        @endif
                    </div>
                </li>
                @endforeach
            </ol>
            @endif
        </div>
    </section>

</div>
