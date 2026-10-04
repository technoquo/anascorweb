<div>

    <div class="pagina-hero" style="background-color: var(--t-fondo-alt);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav aria-label="Ruta de navegación" class="mb-3">
                <ol class="flex items-center gap-2 text-sm" style="color: var(--t-texto-suave);">
                    <li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" style="color: var(--t-texto);">Contacto</li>
                </ol>
            </nav>
            <h1 class="pagina-titulo">Contacto</h1>
        </div>
    </div>

    <section class="py-14" style="background-color: var(--t-fondo);">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                {{-- Información de contacto --}}
                <div>
                    <h2 class="seccion-titulo mb-6">Información de contacto</h2>

                    @if($direccion)
                    <div class="flex gap-3 mb-5">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" style="color:var(--anascor-azul);" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="text-sm leading-relaxed" style="color:var(--t-texto);">{{ $direccion }}</p>
                    </div>
                    @endif

                    @if($correo)
                    <div class="flex gap-3 mb-5">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" style="color:var(--anascor-azul);" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ $correo }}" class="text-sm" style="color:var(--t-enlace);">{{ $correo }}</a>
                    </div>
                    @endif

                    {{-- Redes sociales --}}
                    <div class="flex gap-3 mt-6">
                        @if($facebook)
                        <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer" class="red-social-btn" aria-label="Facebook de ANASCOR (abre en nueva pestaña)">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        @endif
                        @if($instagram)
                        <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer" class="red-social-btn" aria-label="Instagram de ANASCOR (abre en nueva pestaña)">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        @endif
                        @if($tiktok)
                        <a href="{{ $tiktok }}" target="_blank" rel="noopener noreferrer" class="red-social-btn" aria-label="TikTok de ANASCOR (abre en nueva pestaña)">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                        </a>
                        @endif
                    </div>

                    {{-- Mapa --}}
                    @if($mapaUrl)
                    <div class="mt-8 rounded-xl overflow-hidden" style="aspect-ratio:16/10;">
                        <iframe
                            src="{{ $mapaUrl }}"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Ubicación de ANASCOR en Google Maps"
                        ></iframe>
                    </div>
                    @endif
                </div>

                {{-- Formulario --}}
                <div>
                    <h2 class="seccion-titulo mb-6">Envíenos un mensaje</h2>

                    @if($enviado)
                    <div class="rounded-lg p-5 mb-6" style="background-color:#d1fae5;color:#065f46;border:1px solid #6ee7b7;" role="alert">
                        <p class="font-semibold">¡Mensaje enviado!</p>
                        <p class="text-sm mt-1">Gracias por contactarnos. Le responderemos a la brevedad posible.</p>
                    </div>
                    @else

                    @if($errorEnvio)
                    <div class="rounded-lg p-4 mb-5 text-sm" style="background-color:#fee2e2;color:#991b1b;border:1px solid #fca5a5;" role="alert">
                        {{ $errorEnvio }}
                    </div>
                    @endif

                    <form wire:submit="enviar" novalidate>

                        {{-- Honeypot --}}
                        <div style="position:absolute;left:-9999px;opacity:0;pointer-events:none;" aria-hidden="true">
                            <input type="text" wire:model="trampa" tabindex="-1" autocomplete="off" name="website">
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label for="nombre" class="form-label">Nombre <span aria-hidden="true" style="color:var(--anascor-rojo);">*</span></label>
                                <input
                                    type="text"
                                    id="nombre"
                                    wire:model="nombre"
                                    class="form-input @error('nombre') form-input--error @enderror"
                                    autocomplete="name"
                                    required
                                >
                                @error('nombre')
                                <p class="form-error" role="alert">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="correo" class="form-label">Correo electrónico <span aria-hidden="true" style="color:var(--anascor-rojo);">*</span></label>
                                <input
                                    type="email"
                                    id="correo"
                                    wire:model="correo"
                                    class="form-input @error('correo') form-input--error @enderror"
                                    autocomplete="email"
                                    required
                                >
                                @error('correo')
                                <p class="form-error" role="alert">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="asunto" class="form-label">Asunto <span aria-hidden="true" style="color:var(--anascor-rojo);">*</span></label>
                                <input
                                    type="text"
                                    id="asunto"
                                    wire:model="asunto"
                                    class="form-input @error('asunto') form-input--error @enderror"
                                    required
                                >
                                @error('asunto')
                                <p class="form-error" role="alert">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="mensaje" class="form-label">Mensaje <span aria-hidden="true" style="color:var(--anascor-rojo);">*</span></label>
                                <textarea
                                    id="mensaje"
                                    wire:model="mensaje"
                                    rows="5"
                                    class="form-input form-textarea @error('mensaje') form-input--error @enderror"
                                    required
                                ></textarea>
                                @error('mensaje')
                                <p class="form-error" role="alert">{{ $message }}</p>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="btn-enviar"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-70 cursor-not-allowed"
                            >
                                <span wire:loading.remove>Enviar mensaje</span>
                                <span wire:loading>Enviando…</span>
                            </button>
                        </div>
                    </form>
                    @endif
                </div>

            </div>
        </div>
    </section>

</div>
