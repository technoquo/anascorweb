<div>
    <div class="min-h-screen flex items-center justify-center py-16 px-4" style="background-color: var(--t-fondo-alt);">
        <div class="w-full max-w-md">

            {{-- Encabezado --}}
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-block mb-4">
                    <img src="{{ asset('logo/anascor.png') }}" alt="ANASCOR" class="h-16 mx-auto">
                </a>
                <h1 class="text-2xl font-bold" style="color: var(--t-texto);">Área de Asociados</h1>
                <p class="mt-1 text-sm" style="color: var(--t-texto-suave);">Ingresa con tu cédula y contraseña</p>
            </div>

            {{-- Alerta de sesión --}}
            @if(session('mensaje'))
            <div class="mb-4 rounded-lg px-4 py-3 text-sm" style="background-color: var(--t-azul-suave); color: var(--t-azul);" role="alert">
                {{ session('mensaje') }}
            </div>
            @endif
            @if(session('error'))
            <div class="mb-4 rounded-lg px-4 py-3 text-sm" style="background-color: #fee2e2; color: #991b1b;" role="alert">
                {{ session('error') }}
            </div>
            @endif

            {{-- Formulario --}}
            <div class="rounded-2xl shadow-sm p-8" style="background-color: var(--t-fondo); border: 1px solid var(--t-borde);">
                <form wire:submit="ingresar" novalidate>

                    <div class="mb-5">
                        <label for="cedula" class="block text-sm font-medium mb-1.5" style="color: var(--t-texto);">
                            Número de cédula
                        </label>
                        <input
                            type="text"
                            id="cedula"
                            wire:model="cedula"
                            autocomplete="username"
                            inputmode="numeric"
                            class="w-full rounded-lg px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2"
                            style="background-color: var(--t-fondo-alt); border: 1px solid var(--t-borde); color: var(--t-texto);"
                            placeholder="Ej. 101230456"
                        >
                        @error('cedula')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block text-sm font-medium mb-1.5" style="color: var(--t-texto);">
                            Contraseña
                        </label>
                        <input
                            type="password"
                            id="password"
                            wire:model="password"
                            autocomplete="current-password"
                            class="w-full rounded-lg px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2"
                            style="background-color: var(--t-fondo-alt); border: 1px solid var(--t-borde); color: var(--t-texto);"
                        >
                        @error('password')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center mb-6">
                        <input
                            type="checkbox"
                            id="recuerdame"
                            wire:model="recuerdame"
                            class="h-4 w-4 rounded"
                            style="accent-color: var(--t-azul);"
                        >
                        <label for="recuerdame" class="ml-2 text-sm" style="color: var(--t-texto-suave);">
                            Recordar mi sesión
                        </label>
                    </div>

                    <button
                        type="submit"
                        class="btn-primario w-full justify-center py-3"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Ingresar</span>
                        <span wire:loading>Verificando…</span>
                    </button>
                </form>
            </div>

            <p class="text-center mt-6 text-sm" style="color: var(--t-texto-suave);">
                ¿Problemas para ingresar?
                <a href="{{ route('contacto') }}" class="font-medium underline" style="color: var(--t-azul);">Contáctanos</a>
            </p>

        </div>
    </div>
</div>
