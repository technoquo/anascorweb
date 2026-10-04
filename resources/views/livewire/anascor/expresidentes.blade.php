<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" style="color: var(--t-texto);">Ex-presidentes</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">Ex-presidentes de ANASCOR: Liderazgo que deja huella</h1>
        </div>
    </div>

    <section class="py-14" style="background-color: var(--t-fondo);" aria-labelledby="expresidentes-titulo">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($expresidentes->isEmpty())
            <p class="text-center py-16" style="color:var(--t-texto-suave);">No hay ex-presidentes registrados todavía.</p>
            @else
            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6" role="list">
                @foreach($expresidentes as $ep)
                <li class="text-center">
                    <div class="mx-auto mb-4 rounded-xl overflow-hidden" style="width:10rem;height:10rem;background-color:var(--t-borde);">
                        <img
                            src="{{ asset('storage/' . $ep->foto) }}"
                            alt="{{ $ep->nombre }}"
                            class="w-full h-full object-cover"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <p class="font-semibold" style="color:var(--t-texto);">{{ $ep->nombre }}</p>
                    <p class="text-sm mt-1" style="color:var(--t-texto-suave);">
                        {{ $ep->anio_inicio }}{{ $ep->anio_fin ? ' – '.$ep->anio_fin : ' – presente' }}
                    </p>
                </li>
                @endforeach
            </ul>
            @endif

        </div>
    </section>

</div>
