<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#101217">
    <title>{{ trim($__env->yieldContent('title', 'Account')) }} | Full Force Systems</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/full-force-mark.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('css/full-force-auth.css') }}">
    <script src="{{ asset('js/full-force-auth.js') }}" defer></script>
</head>
<body class="ff-auth">
<div class="ff-layout">
    <aside class="ff-aside" aria-label="Full Force Systems">
        <div class="ff-aside-mesh" aria-hidden="true"></div>
        <div class="ff-aside-top">
            <a href="{{ url('/') }}" class="ff-brand ff-brand-light" aria-label="Full Force Systems - home">
                <img src="{{ asset('images/full-force-mark.svg') }}" alt="" width="43" height="43">
                <span class="ff-brand-copy"><strong>FULL FORCE</strong><small>SYSTEMS</small></span>
            </a>
            <div class="ff-live"><span class="ff-dot"></span> VEILIG PORTAAL</div>
        </div>

        <div class="ff-aside-body">
            <div class="ff-eyebrow"><span class="ff-eyebrow-line"></span> FULL FORCE SYSTEMS <span class="ff-eyebrow-line"></span></div>
            <h2>CONTROLE.<br><span>ZEKERHEID.</span><br>VERTROUWEN.</h2>
            <p>Beheer je aanvragen en accountgegevens eenvoudig en veilig vanuit één centrale plek.</p>
            <div class="ff-visual" aria-hidden="true">
                <div class="ff-visual-edge ff-visual-edge-tl"></div><div class="ff-visual-edge ff-visual-edge-br"></div>
                <div class="ff-orbit ff-orbit-outer"></div><div class="ff-orbit ff-orbit-middle"></div>
                <div class="ff-orbit ff-orbit-inner"></div>
                <div class="ff-shield">
                    <svg viewBox="0 0 100 115" fill="none" aria-hidden="true"><path d="M50 4L91 20V50C91 75 74 96 50 110C26 96 9 75 9 50V20L50 4Z" stroke="currentColor" stroke-width="3.2"/><path d="M30 55L44 69L73 38" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="ff-system-readout ff-readout-top"><span class="ff-dot"></span> SYSTEM STATUS <strong>ACTIVE</strong></div>
                <div class="ff-system-readout ff-readout-bottom">SECURE ACCESS <span>●●●●●●</span></div>
            </div>
        </div>

        <div class="ff-aside-bottom"><span>BEVEILIGING DIE VERDER GAAT.</span><span>© {{ date('Y') }} FULL FORCE SYSTEMS</span></div>
    </aside>

    <main class="ff-main" id="main-content">
        <header class="ff-mobile-header">
            <a href="{{ url('/') }}" class="ff-brand ff-brand-dark" aria-label="Full Force Systems - home">
                <img src="{{ asset('images/full-force-mark.svg') }}" alt="" width="40" height="40">
                <span class="ff-brand-copy"><strong>FULL FORCE</strong><small>SYSTEMS</small></span>
            </a>
            <a class="ff-home-link" href="{{ url('/') }}">← Website</a>
        </header>
        <div class="ff-main-top"><a class="ff-back-website" href="{{ url('/') }}"><span aria-hidden="true">←</span> Terug naar website</a></div>
        <div class="ff-content">{{ $slot }}</div>
        <footer class="ff-main-footer"><span>© {{ date('Y') }} Full Force Systems</span><span>Veilig. Betrouwbaar. Professioneel.</span></footer>
    </main>
</div>

<svg xmlns="http://www.w3.org/2000/svg" style="position:absolute;width:0;height:0;overflow:hidden" aria-hidden="true" focusable="false">
    <symbol id="ff-icon-mail" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="1.65"/><path d="m4 7 8 6 8-6" fill="none" stroke="currentColor" stroke-width="1.65" stroke-linejoin="round"/></symbol>
    <symbol id="ff-icon-lock" viewBox="0 0 24 24"><rect x="5" y="10" width="14" height="11" rx="2" fill="none" stroke="currentColor" stroke-width="1.65"/><path d="M8 10V7a4 4 0 0 1 8 0v3" fill="none" stroke="currentColor" stroke-width="1.65"/><path d="M12 14v3" stroke="currentColor" stroke-width="1.65" stroke-linecap="round"/></symbol>
    <symbol id="ff-icon-user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" fill="none" stroke="currentColor" stroke-width="1.65"/><path d="M4.5 21c.3-4 3-6 7.5-6s7.2 2 7.5 6" fill="none" stroke="currentColor" stroke-width="1.65" stroke-linecap="round"/></symbol>
    <symbol id="ff-icon-building" viewBox="0 0 24 24"><rect x="5" y="3" width="14" height="18" rx="2" fill="none" stroke="currentColor" stroke-width="1.65"/><path d="M9 8h1m4 0h1m-6 4h1m4 0h1m-6 4h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></symbol>
    <symbol id="ff-icon-eye" viewBox="0 0 24 24"><path d="M2 12s3.6-6 10-6 10 6 10 6-3.6 6-10 6-10-6-10-6Z" fill="none" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="2.5" fill="none" stroke="currentColor" stroke-width="1.7"/></symbol>
    <symbol id="ff-icon-check" viewBox="0 0 24 24"><path d="m5 12 5 5L20 7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></symbol>
</svg>
</body>
</html>
