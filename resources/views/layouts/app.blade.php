{{--
    Hoofdlayout: elke pagina gebruikt dit bestand met @extends('layouts.app').
    De inhoud van de pagina komt op de plek van @yield('content').
    Per pagina: @section('title', '...') en @section('description', '...'). Zonder die secties gelden de standaardteksten hieronder.
--}}
@php
    // Let op: tekst uit @section('title', '...') is al veilig gemaakt (escaped). Daarom tonen we $titel en
    // $beschrijving met {!! !!}; met {{ }} zou bijvoorbeeld "Camera's" als "Camera&#039;s" verschijnen.
    $titel = View::yieldContent('title', 'Camera- en alarmsystemen').' | '.e(config('site.name'));
    $beschrijving = View::yieldContent('description', 'Camera- en alarmsystemen voor woning en bedrijf. Persoonlijk advies en professionele installatie in Gelderland, Brabant en Limburg.');
@endphp
<!DOCTYPE html>
<html lang="nl" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{!! $titel !!}</title>
        <meta name="description" content="{!! $beschrijving !!}">
        <link rel="canonical" href="{{ url()->current() }}">

        {{-- Voorvertoning als iemand een link deelt (WhatsApp, LinkedIn, Facebook) --}}
        <meta property="og:type" content="website">
        <meta property="og:locale" content="nl_NL">
        <meta property="og:site_name" content="{{ config('site.name') }}">
        <meta property="og:title" content="{!! $titel !!}">
        <meta property="og:description" content="{!! $beschrijving !!}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ asset('images/voorbeeld/hero-camera.jpg') }}">

        {{-- Icoon in het browsertabblad (tijdelijk, tot het officiële logo er is) --}}
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
        <meta name="theme-color" content="#07090b">

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
