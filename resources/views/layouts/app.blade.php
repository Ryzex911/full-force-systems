{{--
    Hoofdlayout: elke pagina gebruikt dit bestand met @extends('layouts.app').
    De inhoud van de pagina komt op de plek van @yield('content').
--}}
<!DOCTYPE html>
<html lang="nl" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Camera- en alarmsystemen') | {{ config('site.name') }}</title>
        <meta name="description" content="@yield('description', 'Camera- en alarmsystemen voor woning en bedrijf. Persoonlijk advies en professionele installatie in Gelderland, Brabant en Limburg.')">

        {{-- Zet het gekozen thema en klanttype vóór het tekenen van de pagina, zodat het niet knippert --}}
        <script>
            try {
                const thema = localStorage.getItem('ffs-thema');
                if (thema) document.documentElement.dataset.theme = thema;

                const klant = localStorage.getItem('ffs-klanttype');
                if (klant) document.documentElement.dataset.klant = klant;
            } catch (e) {}
        </script>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-page font-sans text-ink antialiased">
        <a href="#inhoud" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-50 focus:rounded-lg focus:bg-brand focus:px-4 focus:py-2 focus:text-white">
            Naar de inhoud
        </a>

        @include('partials.header')

        <main id="inhoud">
            @yield('content')
        </main>

        @include('partials.footer')
    </body>
</html>
