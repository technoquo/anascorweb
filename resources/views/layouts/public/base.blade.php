<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
          content="Promueve los derechos de personas sordas, sordociegas y con pérdida auditiva mediante cooperación, campañas, empleo y otros mecanismos con respeto y comprensión.">
    <meta name="keywords"
          content="derecho, sordos, LESCO, igualdad, accesible, cultura sorda, lengua de señas, comites, educación">
    <title>{{ $title ?? 'ANASCOR — Asociación Nacional de Sordos de Costa Rica' }}</title>
    <meta name="description" content="{{ $descripcion ?? 'Asociación Nacional de Sordos de Costa Rica. Defendiendo los derechos de las personas sordas desde 1974.' }}">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ $canonical ?? url()->current() }}">
    <meta name="robots" content="{{ app()->isProduction() ? 'index, follow' : 'noindex, nofollow' }}">

    {{-- Noindex para área privada --}}
    @if(request()->is('asociados/*') || request()->is('admin/*'))
    <meta name="robots" content="noindex,nofollow">
    @else
    <meta name="robots" content="index,follow">
    @endif

    {{-- Open Graph --}}
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:site_name" content="ANASCOR">
    <meta property="og:locale" content="es_CR">
    <meta property="og:title" content="{{ $title ?? 'ANASCOR — Asociación Nacional de Sordos de Costa Rica' }}">
    <meta property="og:description" content="{{ $descripcion ?? 'Asociación Nacional de Sordos de Costa Rica. Defendiendo los derechos de las personas sordas desde 1974.' }}">
    <meta property="og:url" content="{{ $canonical ?? url()->current() }}">
    @if(isset($ogImagen))
    <meta property="og:image" content="{{ $ogImagen }}">
    @else
    <meta property="og:image" content="{{ asset('img/anascor.png') }}">
    @endif


    <link rel="icon" href="{{ asset('img/anascor.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/anascor.ico') }}" type="image/x-icon">
    {{-- Aplicar tema y fuente antes del primer paint para evitar FOUC --}}
    <script>
        (function () {
            var t = localStorage.getItem('anascor-tema')   || 'default';
            var f = localStorage.getItem('anascor-fuente') || 'default';
            document.documentElement.setAttribute('data-tema',   t);
            document.documentElement.setAttribute('data-fuente', f);
        }());

        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TP326ZQ9');
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>
<body class="site-body min-h-screen flex flex-col">

    <a class="skip-link" href="#contenido-principal">Saltar al contenido principal</a>

    <x-public.accesibilidad />
    <x-public.header />

    <main id="contenido-principal" tabindex="-1" class="flex-1">
        {{ $slot }}
    </main>

    <x-public.footer />

    @livewireScripts
</body>
</html>
