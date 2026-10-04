<div
    x-data="{
        tema:   localStorage.getItem('anascor-tema')   || 'default',
        fuente: localStorage.getItem('anascor-fuente') || 'default',
        setTema(valor) {
            this.tema = valor;
            localStorage.setItem('anascor-tema', valor);
            document.documentElement.setAttribute('data-tema', valor);
        },
        setFuente(valor) {
            this.fuente = valor;
            localStorage.setItem('anascor-fuente', valor);
            document.documentElement.setAttribute('data-fuente', valor);
        }
    }"
    class="accesibilidad-bar"
    role="navigation"
    aria-label="Opciones de accesibilidad"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-1.5 flex flex-wrap items-center justify-end gap-x-4 gap-y-1 text-xs">

        {{-- Tamaño del texto --}}
        <div class="flex items-center gap-1.5" role="group" aria-label="Tamaño del texto">
            <span class="font-medium opacity-80 mr-0.5">Texto:</span>
            <button
                type="button"
                @click="setFuente('pequena')"
                :aria-pressed="fuente === 'pequena'"
                class="acces-btn"
                title="Texto pequeño"
                style="font-size: 0.6rem;"
            >A</button>
            <button
                type="button"
                @click="setFuente('default')"
                :aria-pressed="fuente === 'default'"
                class="acces-btn"
                title="Texto normal"
                style="font-size: 0.75rem;"
            >A</button>
            <button
                type="button"
                @click="setFuente('grande')"
                :aria-pressed="fuente === 'grande'"
                class="acces-btn"
                title="Texto grande"
                style="font-size: 0.95rem;"
            >A</button>
        </div>

        <span class="opacity-30 select-none" aria-hidden="true">|</span>

        {{-- Contraste --}}
        <div class="flex items-center gap-1.5" role="group" aria-label="Modo de contraste">
            <span class="font-medium opacity-80 mr-0.5">Contraste:</span>
            <button
                type="button"
                @click="setTema('default')"
                :aria-pressed="tema === 'default'"
                class="acces-btn"
                title="Contraste por defecto"
            >Por defecto</button>
            <button
                type="button"
                @click="setTema('noche')"
                :aria-pressed="tema === 'noche'"
                class="acces-btn acces-btn--noche"
                title="Modo noche"
            >Noche</button>
            <button
                type="button"
                @click="setTema('alto-nb')"
                :aria-pressed="tema === 'alto-nb'"
                class="acces-btn acces-btn--alto-nb"
                title="Alto contraste: negro sobre blanco"
            ><span aria-hidden="true">A</span><span class="sr-only">Negro sobre blanco</span></button>
            <button
                type="button"
                @click="setTema('negro-amarillo')"
                :aria-pressed="tema === 'negro-amarillo'"
                class="acces-btn acces-btn--negro-amarillo"
                title="Negro sobre amarillo"
            ><span aria-hidden="true">A</span><span class="sr-only">Negro sobre amarillo</span></button>
            <button
                type="button"
                @click="setTema('amarillo-negro')"
                :aria-pressed="tema === 'amarillo-negro'"
                class="acces-btn acces-btn--amarillo-negro"
                title="Amarillo sobre negro"
            ><span aria-hidden="true">A</span><span class="sr-only">Amarillo sobre negro</span></button>
        </div>

    </div>
</div>
