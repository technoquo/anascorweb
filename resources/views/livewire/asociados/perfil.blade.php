<div>
    {{-- Hero --}}
    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-4">
                    @if($asociado->foto)
                    <img
                        src="{{ asset('storage/' . $asociado->foto) }}"
                        alt="Foto de {{ $asociado->nombre_completo }}"
                        class="h-16 w-16 rounded-full object-cover"
                        style="border: 2px solid var(--t-azul);"
                    >
                    @else
                    <div class="h-16 w-16 rounded-full flex items-center justify-center text-2xl font-bold"
                        style="background-color: var(--t-azul); color: #fff;">
                        {{ mb_substr($asociado->nombre_completo, 0, 1) }}
                    </div>
                    @endif
                    <div>
                        <h1 class="pagina-titulo mb-0">{{ $asociado->nombre_completo }}</h1>
                        <p class="text-sm mt-0.5" style="color: var(--t-texto-suave);">Cédula: {{ $asociado->cedula }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('asociados.cambiar-password') }}" class="btn-secundario text-sm">
                        Cambiar contraseña
                    </a>
                    <button wire:click="salir" class="btn-rojo text-sm">
                        Cerrar sesión
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

        {{-- Estado de cuota --}}
        <section aria-labelledby="titulo-estado">
            <h2 id="titulo-estado" class="seccion-titulo text-lg mb-4">Estado de membresía</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="rounded-xl p-5" style="background-color: var(--t-fondo-alt); border: 1px solid var(--t-borde);">
                    <p class="text-xs font-semibold uppercase tracking-wide mb-1" style="color: var(--t-texto-suave);">Estado</p>
                    @if($asociado->moroso)
                    <p class="text-lg font-bold text-red-600">Moroso</p>
                    @else
                    <p class="text-lg font-bold" style="color: #16a34a;">Al día</p>
                    @endif
                </div>
                <div class="rounded-xl p-5" style="background-color: var(--t-fondo-alt); border: 1px solid var(--t-borde);">
                    <p class="text-xs font-semibold uppercase tracking-wide mb-1" style="color: var(--t-texto-suave);">Plan de cuota</p>
                    <p class="text-lg font-bold" style="color: var(--t-texto);">
                        {{ match($asociado->plan_cuota) {
                            'mensual' => 'Mensual',
                            'trimestral' => 'Trimestral',
                            'anual' => 'Anual',
                            default => $asociado->plan_cuota,
                        } }}
                    </p>
                </div>
                <div class="rounded-xl p-5" style="background-color: var(--t-fondo-alt); border: 1px solid var(--t-borde);">
                    <p class="text-xs font-semibold uppercase tracking-wide mb-1" style="color: var(--t-texto-suave);">Pagado hasta</p>
                    <p class="text-lg font-bold" style="color: var(--t-texto);">
                        {{ $asociado->pagado_hasta ? $asociado->pagado_hasta->translatedFormat('j \d\e F, Y') : 'Sin registro' }}
                    </p>
                </div>
            </div>
        </section>

        {{-- Datos personales --}}
        <section aria-labelledby="titulo-datos">
            <div class="flex items-center justify-between mb-4">
                <h2 id="titulo-datos" class="seccion-titulo text-lg mb-0">Mis datos</h2>
                @if(!$editando)
                <button wire:click="$set('editando', true)" class="btn-secundario text-sm">
                    Editar datos de contacto
                </button>
                @endif
            </div>

            @if($guardado)
            <div class="mb-4 rounded-lg px-4 py-3 text-sm" style="background-color: #dcfce7; color: #166534;" role="alert">
                Datos actualizados correctamente.
            </div>
            @endif

            <div class="rounded-xl p-6" style="background-color: var(--t-fondo-alt); border: 1px solid var(--t-borde);">
                @if($editando)
                <form wire:submit="guardar" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: var(--t-texto);">Ciudad</label>
                            <input type="text" wire:model="ciudad"
                                class="w-full rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2"
                                style="background-color: var(--t-fondo); border: 1px solid var(--t-borde); color: var(--t-texto);">
                            @error('ciudad') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: var(--t-texto);">Teléfono</label>
                            <input type="tel" wire:model="telefono"
                                class="w-full rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2"
                                style="background-color: var(--t-fondo); border: 1px solid var(--t-borde); color: var(--t-texto);">
                            @error('telefono') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1" style="color: var(--t-texto);">Correo electrónico</label>
                        <input type="email" wire:model="correo"
                            class="w-full rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2"
                            style="background-color: var(--t-fondo); border: 1px solid var(--t-borde); color: var(--t-texto);">
                        @error('correo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1" style="color: var(--t-texto);">Dirección</label>
                        <textarea wire:model="direccion" rows="2"
                            class="w-full rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2"
                            style="background-color: var(--t-fondo); border: 1px solid var(--t-borde); color: var(--t-texto);"></textarea>
                        @error('direccion') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="btn-primario text-sm" wire:loading.attr="disabled">
                            <span wire:loading.remove>Guardar cambios</span>
                            <span wire:loading>Guardando…</span>
                        </button>
                        <button type="button" wire:click="$set('editando', false)" class="btn-secundario text-sm">
                            Cancelar
                        </button>
                    </div>
                </form>
                @else
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                    <div>
                        <dt class="font-medium mb-0.5" style="color: var(--t-texto-suave);">Fecha de nacimiento</dt>
                        <dd style="color: var(--t-texto);">{{ $asociado->fecha_nacimiento->translatedFormat('j \d\e F, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium mb-0.5" style="color: var(--t-texto-suave);">Provincia / Cantón</dt>
                        <dd style="color: var(--t-texto);">{{ $asociado->provincia->nombre }} — {{ $asociado->canton->nombre }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium mb-0.5" style="color: var(--t-texto-suave);">Ciudad</dt>
                        <dd style="color: var(--t-texto);">{{ $asociado->ciudad }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium mb-0.5" style="color: var(--t-texto-suave);">Teléfono</dt>
                        <dd style="color: var(--t-texto);">{{ $asociado->telefono ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium mb-0.5" style="color: var(--t-texto-suave);">Correo electrónico</dt>
                        <dd style="color: var(--t-texto);">{{ $asociado->correo ?: '—' }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium mb-0.5" style="color: var(--t-texto-suave);">Fecha de afiliación</dt>
                        <dd style="color: var(--t-texto);">{{ $asociado->fecha_afiliacion->translatedFormat('j \d\e F, Y') }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="font-medium mb-0.5" style="color: var(--t-texto-suave);">Dirección</dt>
                        <dd style="color: var(--t-texto);">{{ $asociado->direccion }}</dd>
                    </div>
                </dl>
                @endif
            </div>
        </section>

        {{-- Historial de pagos --}}
        @if($asociado->pagos->isNotEmpty())
        <section aria-labelledby="titulo-pagos">
            <h2 id="titulo-pagos" class="seccion-titulo text-lg mb-4">Historial de pagos</h2>
            <div class="overflow-x-auto rounded-xl" style="border: 1px solid var(--t-borde);">
                <table class="w-full text-sm" style="color: var(--t-texto);">
                    <thead style="background-color: var(--t-fondo-alt);">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Fecha de pago</th>
                            <th class="px-4 py-3 text-left font-semibold">Plan</th>
                            <th class="px-4 py-3 text-right font-semibold">Monto</th>
                            <th class="px-4 py-3 text-left font-semibold">Cubre hasta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($asociado->pagos as $pago)
                        <tr style="border-top: 1px solid var(--t-borde);">
                            <td class="px-4 py-3">{{ $pago->pagado_en->translatedFormat('j \d\e F, Y') }}</td>
                            <td class="px-4 py-3">{{ ucfirst($pago->plan) }}</td>
                            <td class="px-4 py-3 text-right">₡{{ number_format($pago->monto, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $pago->cubre_hasta->translatedFormat('j \d\e F, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        @endif

    </div>
</div>
