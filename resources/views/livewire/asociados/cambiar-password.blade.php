<div>
    <div class="min-h-screen flex items-center justify-center py-16 px-4" style="background-color: var(--t-fondo-alt);">
        <div class="w-full max-w-md">

            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-block mb-4">
                    <img src="{{ asset('logo/anascor.png') }}" alt="ANASCOR" class="h-16 mx-auto">
                </a>
                <h1 class="text-2xl font-bold" style="color: var(--t-texto);">Cambiar contraseña</h1>
                <p class="mt-1 text-sm" style="color: var(--t-texto-suave);">Por seguridad debes establecer una nueva contraseña antes de continuar.</p>
            </div>

            <div class="rounded-2xl shadow-sm p-8" style="background-color: var(--t-fondo); border: 1px solid var(--t-borde);">
                <form wire:submit="cambiar" novalidate>

                    <div class="mb-5">
                        <label for="password_actual" class="block text-sm font-medium mb-1.5" style="color: var(--t-texto);">
                            Contraseña actual
                        </label>
                        <input
                            type="password"
                            id="password_actual"
                            wire:model="password_actual"
                            autocomplete="current-password"
                            class="w-full rounded-lg px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2"
                            style="background-color: var(--t-fondo-alt); border: 1px solid var(--t-borde); color: var(--t-texto);"
                        >
                        @error('password_actual')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="password_nuevo" class="block text-sm font-medium mb-1.5" style="color: var(--t-texto);">
                            Nueva contraseña
                        </label>
                        <input
                            type="password"
                            id="password_nuevo"
                            wire:model="password_nuevo"
                            autocomplete="new-password"
                            class="w-full rounded-lg px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2"
                            style="background-color: var(--t-fondo-alt); border: 1px solid var(--t-borde); color: var(--t-texto);"
                        >
                        @error('password_nuevo')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password_nuevo_confirmation" class="block text-sm font-medium mb-1.5" style="color: var(--t-texto);">
                            Confirmar nueva contraseña
                        </label>
                        <input
                            type="password"
                            id="password_nuevo_confirmation"
                            wire:model="password_nuevo_confirmation"
                            autocomplete="new-password"
                            class="w-full rounded-lg px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2"
                            style="background-color: var(--t-fondo-alt); border: 1px solid var(--t-borde); color: var(--t-texto);"
                        >
                    </div>

                    <button
                        type="submit"
                        class="btn-primario w-full justify-center py-3"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Guardar nueva contraseña</span>
                        <span wire:loading>Guardando…</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
