<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title ?? 'ANASCOR — Asociación Nacional de Sordos de Costa Rica' }}</title>
    <meta name="description" content="{{ $descripcion ?? 'Asociación Nacional de Sordos de Costa Rica. Defendiendo los derechos de las personas sordas desde 1974.' }}">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ $canonical ?? url()->current() }}">

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
    <meta property="og:image" content="{{ asset('logo/anascor.png') }}">
    @endif

    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    {{-- Aplicar tema y fuente antes del primer paint para evitar FOUC --}}
    <script>
        (function () {
            var t = localStorage.getItem('anascor-tema')   || 'default';
            var f = localStorage.getItem('anascor-fuente') || 'default';
            document.documentElement.setAttribute('data-tema',   t);
            document.documentElement.setAttribute('data-fuente', f);
        }());
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
