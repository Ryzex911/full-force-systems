@php
    $pages = config('legal.pages', []);
    $company = config('legal.company', []);
    $approved = config('legal.approved', false);
@endphp

    <!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Juridische informatie') | Full Force Systems
    </title>

    <meta name="description"
          content="@yield('description', 'Juridische informatie van Full Force Systems.')">

    @unless($approved)
        <meta name="robots" content="noindex,nofollow">
    @endunless

    <meta name="theme-color" content="#111318">

    <script>
        (function () {
            try {
                const saved = localStorage.getItem('ffs-theme');

                const preferred = window.matchMedia(
                    '(prefers-color-scheme: dark)'
                ).matches ? 'dark' : 'light';

                document.documentElement.dataset.theme =
                    ['light', 'dark'].includes(saved) ? saved : preferred;
            } catch (error) {
                document.documentElement.dataset.theme = 'light';
            }
        })();
    </script>

    <link rel="stylesheet"
          href="{{ asset('css/legal.css') }}">

    <script src="{{ asset('js/legal.js') }}" defer></script>
</head>

<body>

<div class="site-shell">

    {{-- HEADER --}}
    <header class="site-header">

        <div class="container header-content">

            <a href="{{ url('/') }}"
               class="brand"
               aria-label="Full Force Systems - Home">

                <div class="brand-symbol">
                    F
                </div>

                <div class="brand-text">
                    <strong>FULL FORCE</strong>
                    <span>SYSTEMS</span>
                </div>

            </a>

            <div class="header-actions">

                <a href="{{ url('/') }}"
                   class="header-link">
                    Home
                </a>

                <a href="{{ route('legal.index') }}"
                   class="header-link">
                    Juridisch
                </a>

                {{-- LIGHT / DARK MODE --}}
                <button
                    type="button"
                    class="theme-toggle"
                    data-theme-toggle
                    aria-label="Wissel tussen lichte en donkere modus"
                >

                    <svg class="moon-icon"
                         width="18"
                         height="18"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">

                        <path d="M20.9 13A9 9 0 0 1 11 3.1 9 9 0 1 0 20.9 13Z"/>

                    </svg>

                    <svg class="sun-icon"
                         width="18"
                         height="18"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">

                        <circle cx="12" cy="12" r="4"/>

                        <path d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32 1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>

                    </svg>

                    <span data-theme-label>
                        Thema
                    </span>

                </button>

                @auth

                    <a href="{{ url('/dashboard') }}"
                       class="header-button">
                        Mijn account
                        <span>↗</span>
                    </a>

                @else

                    <a href="{{ route('login') }}"
                       class="header-button">
                        Inloggen
                        <span>↗</span>
                    </a>

                @endauth

            </div>

        </div>

    </header>


    {{-- HERO --}}
    <section class="legal-hero">

        <div class="hero-grid"></div>
        <div class="hero-glow"></div>

        <div class="container hero-content">

            <div class="hero-breadcrumb">

                <a href="{{ url('/') }}">
                    Home
                </a>

                <span>/</span>

                <a href="{{ route('legal.index') }}">
                    Juridisch
                </a>

                <span>/</span>

                <strong>
                    @yield('breadcrumb', 'Overzicht')
                </strong>

            </div>

            <div class="hero-label">

                <span class="label-line"></span>

                FULL FORCE SYSTEMS

                <span class="label-dot"></span>

                LEGAL CENTER

            </div>

            <h1>
                @yield('hero-title', 'Juridische informatie')
            </h1>

            <p>
                @yield('hero-description', 'Duidelijke afspraken, transparante informatie en betrouwbare dienstverlening.')
            </p>

            <div class="hero-bottom">

                <span class="hero-status">

                    <span class="status-dot"></span>

                    DOCUMENTATIE

                </span>

                <span>
                    07 DOCUMENTEN
                </span>

            </div>

        </div>

    </section>


    {{-- MAIN --}}
    <main class="main-section">

        <div class="container">

            @unless($approved)

                <div class="project-notice">

                    <div class="notice-icon">
                        !
                    </div>

                    <div>

                        <strong>
                            Concept voor schoolproject
                        </strong>

                        <p>
                            De juridische teksten zijn nog niet
                            definitief goedgekeurd door de opdrachtgever.
                            Bedrijfsgegevens en voorwaarden moeten
                            worden gecontroleerd voordat de website
                            commercieel wordt gebruikt.
                        </p>

                    </div>

                </div>

            @endunless


            <div class="legal-layout">

                {{-- SIDEBAR --}}
                <aside class="legal-sidebar">

                    <div class="sidebar-heading">

                        <span class="sidebar-dot"></span>

                        NAVIGATIE

                    </div>

                    <nav class="sidebar-navigation"
                         aria-label="Juridische navigatie">

                        <a href="{{ route('legal.index') }}"
                           class="sidebar-item {{ request()->routeIs('legal.index') ? 'active' : '' }}">

                            <span class="sidebar-number">
                                00
                            </span>

                            <span>Overzicht</span>

                            <span class="sidebar-arrow">
                                ↗
                            </span>

                        </a>


                        @foreach($pages as $key => $page)

                            <a
                                href="{{ route('legal.' . $key) }}"
                                class="sidebar-item {{ request()->routeIs('legal.' . $key) ? 'active' : '' }}"
                            >

                                <span class="sidebar-number">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>

                                <span>
                                    {{ $page['title'] }}
                                </span>

                                <span class="sidebar-arrow">
                                    ↗
                                </span>

                            </a>

                        @endforeach

                    </nav>


                    <div class="sidebar-support">

                        <div class="support-icon">
                            ?
                        </div>

                        <h3>
                            Vragen over onze voorwaarden?
                        </h3>

                        <p>
                            Heb je een vraag over privacy,
                            garantie of een van onze voorwaarden?
                        </p>

                        @if(!empty($company['email']))

                            <a href="mailto:{{ $company['email'] }}">
                                Neem contact op ↗
                            </a>

                        @else

                            <span class="support-pending">
                                Contactgegevens volgen
                            </span>

                        @endif

                    </div>

                </aside>


                {{-- CONTENT --}}
                <div class="legal-main-content">

                    @yield('content')

                </div>

            </div>

        </div>

    </main>


    {{-- FOOTER --}}
    <footer class="site-footer">

        <div class="container">

            <div class="footer-main">

                <div class="footer-about">

                    <div class="footer-brand">
                        FULL FORCE <span>SYSTEMS</span>
                    </div>

                    <p>
                        Veiligheid, betrouwbaarheid en
                        professionele oplossingen voor
                        particuliere en zakelijke klanten.
                    </p>

                    <div class="footer-status">
                        <span></span>
                        FULL FORCE SYSTEMS
                    </div>

                </div>


                <div class="footer-column">

                    <h4>JURIDISCH</h4>

                    @foreach($pages as $key => $page)

                        <a href="{{ route('legal.' . $key) }}">
                            {{ $page['title'] }}
                        </a>

                    @endforeach

                </div>


                <div class="footer-column">

                    <h4>NAVIGATIE</h4>

                    <a href="{{ url('/') }}">
                        Home
                    </a>

                    <a href="{{ route('legal.index') }}">
                        Juridisch overzicht
                    </a>

                    @auth
                        <a href="{{ url('/dashboard') }}">
                            Mijn account
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            Inloggen
                        </a>
                    @endauth

                </div>

            </div>


            <div class="footer-bottom">

                <span>
                    © {{ date('Y') }} Full Force Systems
                </span>

                <span>
                    VEILIGHEID • VERTROUWEN • KWALITEIT
                </span>

            </div>

        </div>

    </footer>

</div>

</body>
</html>
