{{--
    Hero: grote kop op een foto, met rechts de keuzehulp "woning of bedrijf".
    Deze sectie blijft ook in het lichte thema donker, omdat de witte tekst op de foto staat.
--}}
<section class="relative isolate overflow-hidden bg-night">
    <img
        src="{{ asset('images/voorbeeld/hero-camera.jpg') }}"
        alt=""
        class="absolute inset-0 -z-20 size-full object-cover"
        fetchpriority="high"
    >
    {{-- Donkere laag over de foto, zodat de tekst leesbaar blijft --}}
    <div class="absolute inset-0 -z-10 bg-linear-to-r from-night/95 via-night/85 to-night/60"></div>

    <div class="wrap flex flex-col gap-12 py-16 lg:flex-row lg:items-center lg:justify-between lg:gap-16 lg:py-[104px]">
        <div class="flex max-w-[660px] flex-col items-start gap-6">
            <p class="text-label flex items-center gap-2.5 text-white">
                <span class="size-2 rounded-full bg-brand"></span>
                Camera · Alarm · Toegang · Intercom
            </p>

            <h1 class="text-display text-white">Beveiliging zonder compromis</h1>

            <p class="text-body-lg max-w-[560px] text-white/80">
                Camera- en alarmsystemen voor uw woning of bedrijf. Persoonlijk advies, professionele installatie en duidelijke uitleg — in
                {{ implode(', ', array_slice(config('site.regions'), 0, -1)) }} en {{ last(config('site.regions')) }}.
            </p>

            {{-- De hoofdactie (rode knop) volgt de keuze particulier / zakelijk in de header --}}
            <div class="flex flex-wrap gap-3 zakelijk:hidden">
                <x-button href="#pakketten">Pakket bekijken</x-button>
                <x-button variant="on-image" href="#offerte">Offerte aanvragen</x-button>
            </div>
            <div class="hidden flex-wrap gap-3 zakelijk:flex">
                <x-button href="#offerte">Offerte aanvragen</x-button>
                <x-button variant="on-image" href="#pakketten">Pakketten bekijken</x-button>
            </div>
        </div>

        {{-- Keuzehulp: particulier gaat naar de pakketten, zakelijk naar de offerte --}}
        <div class="flex w-full flex-col gap-4 rounded-2xl border border-line bg-surface p-7 lg:w-[420px] lg:shrink-0">
            <p class="text-label text-brand-ink">Start hier</p>
            <h2 class="text-h3 text-ink">Waar zoekt u beveiliging voor?</h2>

            <a href="#pakketten" class="group flex items-center gap-4 rounded-xl bg-surface-2 p-[18px] transition-colors hover:bg-line">
                <span class="icon-tile size-11">
                    <x-icon name="home" class="size-[22px]" />
                </span>
                <span class="flex grow flex-col gap-0.5">
                    <span class="text-h4 text-ink">Mijn woning</span>
                    <span class="text-body-sm text-ink-2">Vaste prijs · pakket bekijken</span>
                </span>
                <x-icon name="arrow" class="size-5 text-ink-2 transition-transform group-hover:translate-x-1" />
            </a>

            <a href="#offerte" class="group flex items-center gap-4 rounded-xl bg-surface-2 p-[18px] transition-colors hover:bg-line">
                <span class="icon-tile size-11">
                    <x-icon name="building" class="size-[22px]" />
                </span>
                <span class="flex grow flex-col gap-0.5">
                    <span class="text-h4 text-ink">Mijn bedrijf</span>
                    <span class="text-body-sm text-ink-2">Maatwerk · offerte aanvragen</span>
                </span>
                <x-icon name="arrow" class="size-5 text-ink-2 transition-transform group-hover:translate-x-1" />
            </a>
        </div>
    </div>
</section>
