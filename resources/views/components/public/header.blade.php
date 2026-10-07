<header
    x-data="{ menuAbierto: false }"
    class="public-header"
    role="banner"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-32 gap-4">

            {{-- Logo --}}
            <a
                href="{{ route('home') }}"
                class="shrink-0 size-24 lg:size-28 rounded-full bg-white shadow-sm flex items-center justify-center focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2"
                style="--tw-ring-color: var(--t-enlace);"
                aria-label="Inicio — ANASCOR"
            >
                <img
                    src="{{ \App\Models\Ajuste::logoUrl('logo_header') }}"
                    alt="ANASCOR — Asociación Nacional de Sordos de Costa Rica"
                    class="h-20 lg:h-24 w-auto"
                    loading="eager"
                    decoding="async"
                >
            </a>

            {{-- Navegación de escritorio --}}
            <nav class="hidden lg:flex items-center gap-0.5" aria-label="Menú principal">

                {{-- ANASCOR con submenú --}}
                <div class="relative" x-data="{ abierto: false }" @keydown.escape.window="abierto = false">
                    <button
                        type="button"
                        class="public-nav-link"
                        @click="abierto = !abierto"
                        @click.outside="abierto = false"
                        :aria-expanded="abierto.toString()"
                        aria-haspopup="menu"
                        aria-controls="submenu-anascor"
                    >
                        ANASCOR
                        <svg
                            class="w-4 h-4 transition-transform duration-200"
                            :class="{ 'rotate-180': abierto }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div
                        id="submenu-anascor"
                        x-show="abierto"
                        x-cloak
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="nav-dropdown"
                        role="menu"
                        aria-label="Submenú ANASCOR"
                    >
                        <a href="{{ url('/anascor/quienes-somos') }}"   class="nav-dropdown-item" role="menuitem">¿Qué es la ANASCOR?</a>
                        <a href="{{ url('/anascor/nuestro-trabajo') }}"  class="nav-dropdown-item" role="menuitem">Nuestro Trabajo</a>
                        <a href="{{ url('/anascor/historia') }}"          class="nav-dropdown-item" role="menuitem">Historia de las Asociaciones</a>
                        <a href="{{ url('/anascor/estructura') }}"        class="nav-dropdown-item" role="menuitem">Estructura de Administración</a>
                        <a href="{{ url('/anascor/expresidentes') }}"    class="nav-dropdown-item" role="menuitem">Ex-presidentes de ANASCOR</a>
                        <div class="my-1 border-t" style="border-color: var(--t-borde);"></div>
                        <a href="{{ url('/anascor/academias') }}"         class="nav-dropdown-item" role="menuitem">Convenio con Academias de LESCO</a>
                        <a href="{{ url('/anascor/convenios') }}"         class="nav-dropdown-item" role="menuitem">Convenio con Hellen AI y SignBridge</a>
                        <div class="my-1 border-t" style="border-color: var(--t-borde);"></div>
                        <a
                            href="https://wfdeaf.org"
                            class="nav-dropdown-item"
                            role="menuitem"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Federación Mundial de Sordos
                            <svg class="w-3.5 h-3.5 ml-auto opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            <span class="sr-only">(abre en pestaña nueva)</span>
                        </a>
                    </div>
                </div>

                <a href="{{ url('/lesco') }}"    class="public-nav-link">LESCO</a>
                <a href="{{ url('/galeria') }}"  class="public-nav-link">Galería</a>
                <a href="{{ url('/comites') }}"  class="public-nav-link">Comités</a>
                <a href="{{ url('/contacto') }}" class="public-nav-link">Contacto</a>
            </nav>

            {{-- Buscador + Asociados + Hamburguesa --}}
            <div class="flex items-center gap-2">

                {{-- Buscador (escritorio) --}}
                <form
                    action="{{ url('/buscar') }}"
                    method="GET"
                    role="search"
                    class="hidden md:flex"
                    aria-label="Búsqueda en el sitio"
                >
                    <label for="busqueda-header" class="sr-only">Buscar en el sitio</label>
                    <input
                        id="busqueda-header"
                        type="search"
                        name="q"
                        placeholder="Buscar…"
                        class="public-search-input"
                        autocomplete="off"
                        maxlength="120"
                    >
                    <button type="submit" class="public-search-btn" aria-label="Buscar">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                    </button>
                </form>

                {{-- Botón Asociados --}}
                <a href="{{ url('/asociados/ingresar') }}" class="btn-asociados hidden sm:inline-flex">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Asociados
                </a>

                {{-- Botón hamburguesa (móvil) --}}
                <button
                    type="button"
                    class="lg:hidden p-2 rounded-md"
                    style="color: var(--t-nav-texto);"
                    @click="menuAbierto = !menuAbierto"
                    :aria-expanded="menuAbierto.toString()"
                    aria-controls="menu-movil"
                    :aria-label="menuAbierto ? 'Cerrar menú' : 'Abrir menú'"
                >
                    <svg x-show="!menuAbierto" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="menuAbierto" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menú móvil --}}
    <div
        id="menu-movil"
        x-show="menuAbierto"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden border-t"
        style="background-color: var(--t-header-fondo); border-color: var(--t-borde);"
        role="navigation"
        aria-label="Menú móvil"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 space-y-0.5">

            {{-- Búsqueda móvil --}}
            <form
                action="{{ url('/buscar') }}"
                method="GET"
                role="search"
                class="pb-3 mb-2 border-b"
                style="border-color: var(--t-borde);"
                aria-label="Búsqueda móvil"
            >
                <div class="flex">
                    <label for="busqueda-movil" class="sr-only">Buscar en el sitio</label>
                    <input
                        id="busqueda-movil"
                        type="search"
                        name="q"
                        placeholder="Buscar…"
                        class="public-search-input flex-1"
                        style="border-radius: 0.375rem 0 0 0.375rem; border-right: none;"
                        autocomplete="off"
                    >
                    <button type="submit" class="public-search-btn" aria-label="Buscar">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                    </button>
                </div>
            </form>

            {{-- ANASCOR acordeón --}}
            <div x-data="{ abierto: false }">
                <button
                    type="button"
                    class="public-nav-link w-full justify-between"
                    @click="abierto = !abierto"
                    :aria-expanded="abierto.toString()"
                >
                    ANASCOR
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': abierto }" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="abierto" x-cloak class="pl-4 mt-0.5 space-y-0.5">
                    <a href="{{ url('/anascor/quienes-somos') }}"  class="nav-dropdown-item rounded-md">¿Qué es la ANASCOR?</a>
                    <a href="{{ url('/anascor/nuestro-trabajo') }}" class="nav-dropdown-item rounded-md">Nuestro Trabajo</a>
                    <a href="{{ url('/anascor/historia') }}"         class="nav-dropdown-item rounded-md">Historia de las Asociaciones</a>
                    <a href="{{ url('/anascor/estructura') }}"       class="nav-dropdown-item rounded-md">Estructura de Administración</a>
                    <a href="{{ url('/anascor/expresidentes') }}"   class="nav-dropdown-item rounded-md">Ex-presidentes de ANASCOR</a>
                    <a href="{{ url('/anascor/academias') }}"        class="nav-dropdown-item rounded-md">Convenio con Academias de LESCO</a>
                    <a href="{{ url('/anascor/convenios') }}"        class="nav-dropdown-item rounded-md">Convenio con Hellen AI y SignBridge</a>
                    <a href="https://wfdeaf.org" class="nav-dropdown-item rounded-md" target="_blank" rel="noopener noreferrer">
                        Federación Mundial de Sordos
                        <span class="sr-only">(abre en pestaña nueva)</span>
                    </a>
                </div>
            </div>

            <a href="{{ url('/lesco') }}"    class="public-nav-link block">LESCO</a>
            <a href="{{ url('/galeria') }}"  class="public-nav-link block">Galería</a>
            <a href="{{ url('/comites') }}"  class="public-nav-link block">Comités</a>
            <a href="{{ url('/contacto') }}" class="public-nav-link block">Contacto</a>

            <div class="pt-3 mt-2 border-t" style="border-color: var(--t-borde);">
                <a href="{{ url('/asociados/ingresar') }}" class="btn-asociados w-full justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Acceso de Asociados
                </a>
            </div>
        </div>
    </div>
</header>
