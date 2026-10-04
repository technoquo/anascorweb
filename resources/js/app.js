document.addEventListener('alpine:init', () => {
    Alpine.store('lb', {
        open: false,
        fotos: [],
        indice: 0,
        abrir(fotos, i) {
            this.fotos = fotos;
            this.indice = i;
            this.open = true;
            document.body.style.overflow = 'hidden';
        },
        cerrar() {
            this.open = false;
            document.body.style.overflow = '';
        },
        anterior() {
            if (this.fotos.length === 0) return;
            this.indice = (this.indice - 1 + this.fotos.length) % this.fotos.length;
        },
        siguiente() {
            if (this.fotos.length === 0) return;
            this.indice = (this.indice + 1) % this.fotos.length;
        },
    });
});

document.addEventListener('keydown', e => {
    const lb = window.Alpine?.store('lb');
    if (!lb?.open) return;
    if (e.key === 'Escape')     lb.cerrar();
    if (e.key === 'ArrowLeft')  lb.anterior();
    if (e.key === 'ArrowRight') lb.siguiente();
});
