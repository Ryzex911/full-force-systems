{{--
    Header: bovenbalk met contactgegevens + navigatiebalk.
    De menu-items staan in config/site.php ('nav').
    Het mobiele menu, de themaknop en de keuze particulier/zakelijk werken via resources/js/app.js.
--}}
@use('App\Support\Nav')

<header class="sticky top-0 z-40 bg-page">
    {{-- Bovenbalk (alleen vanaf tablet) --}}
    <div class="hidden bg-alt md:block">
        <div class="wrap flex h-10 items-center justify-between gap-6">
            <ul class="text-body-sm flex items-center gap-7 text-ink-2">
                <li class="flex items-center gap-2">
                    <x-icon name="clock" class="size-4 text-ink-3" />
                    {{ config('site.hours') }}
                </li>
                <li>
                    <a href="{{ config('site.phone_href') }}" class="flex items-center gap-2 hover:text-ink">
                        <x-icon name="phone" class="size-4 text-ink-3" />
                        {{ config('site.phone') }}
                    </a>
                </li>
                <li class="hidden items-center gap-2 lg:flex">
                    <x-icon name="pin" class="size-4 text-ink-3" />
                    {{ implode(' · ', config('site.regions')) }}
                </li>
            </ul>

            @include('partials.klanttype-keuze')
        </div>
    </div>

    {{-- Navigatiebalk --}}
    <div class="border-b border-line">
        <div class="wrap flex h-[72px] items-center justify-between gap-6 lg:h-20">
            <x-logo class="shrink-0" />

            <nav class="hidden lg:block" aria-label="Hoofdnavigatie">
                <ul class="flex items-center gap-6 xl:gap-8">
                    @foreach (config('site.nav') as $item)
                        @php
                            $actief = $item['route'] && request()->routeIs($item['route']);
                        @endphp
                        <li>
                            <a
                                href="{{ Nav::href($item) }}"
                                class="relative block py-2 text-[15px] leading-5 font-medium whitespace-nowrap {{ $actief ? 'text-ink' : 'text-ink-2 hover:text-ink' }}"
                                @if ($actief) aria-current="page" @endif
                            >
                                {{ $item['label'] }}
                                @if ($actief)
                                    <span class="absolute inset-x-0 bottom-0 mx-auto h-0.5 w-6 rounded-full bg-brand"></span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="flex items-center gap-1 sm:gap-2">
                <a href="#" class="hidden size-10 items-center justify-center rounded-lg text-ink hover:bg-surface-2 sm:flex" aria-label="Zoeken">
                    <x-icon name="search" class="size-[22px]" />
                </a>
                <a href="#" class="flex size-10 items-center justify-center rounded-lg text-ink hover:bg-surface-2" aria-label="Mijn account">
                    <x-icon name="user" class="size-[22px]" />
                </a>
                <a href="#" class="flex size-10 items-center justify-center rounded-lg text-ink hover:bg-surface-2" aria-label="Winkelwagen">
                    <x-icon name="cart" class="size-[22px]" />
                </a>

                {{-- Wissel tussen donker en licht --}}
                <button type="button" data-thema-knop class="flex size-10 items-center justify-center rounded-lg text-ink hover:bg-surface-2" aria-label="Wissel tussen donker en licht thema">
                    <x-icon name="sun" class="size-[22px] light:hidden" />
                    <x-icon name="moon" class="hidden size-[22px] light:block" />
                </button>

                <div class="ml-2 hidden xl:block">
                    <x-button href="#offerte">Offerte aanvragen</x-button>
                </div>

                {{-- Menuknop voor mobiel: toont een kruisje zolang het menu open is (aria-expanded="true") --}}
                <button type="button" data-menu-knop class="group flex size-10 items-center justify-center rounded-lg text-ink hover:bg-surface-2 lg:hidden" aria-label="Menu openen" aria-expanded="false" aria-controls="mobiel-menu">
                    <x-icon name="menu" class="size-6 group-aria-expanded:hidden" />
                    <x-icon name="close" class="hidden size-6 group-aria-expanded:block" />
                </button>
            </div>
        </div>
    </div>

    {{-- Mobiel menu (standaard verborgen) --}}
    <div id="mobiel-menu" class="hidden border-b border-line bg-page lg:hidden">
        <nav class="wrap flex flex-col gap-1 py-4" aria-label="Mobiele navigatie">
            @foreach (config('site.nav') as $item)
                @php
                    $actief = $item['route'] && request()->routeIs($item['route']);
                @endphp
                <a
                    href="{{ Nav::href($item) }}"
                    class="rounded-lg px-3 py-3 text-[16px] font-medium {{ $actief ? 'bg-brand-soft text-brand-ink' : 'text-ink-2 hover:bg-surface-2 hover:text-ink' }}"
                    @if ($actief) aria-current="page" @endif
                >
                    {{ $item['label'] }}
                </a>
            @endforeach

            <div class="mt-3 flex flex-col gap-4 border-t border-line pt-4">
                <div class="md:hidden">
                    @include('partials.klanttype-keuze')
                </div>
                <x-button href="#offerte" class="w-full">Offerte aanvragen</x-button>
                <a href="{{ config('site.phone_href') }}" class="text-body-sm flex items-center gap-2 text-ink-2">
                    <x-icon name="phone" class="size-4 text-ink-3" />
                    {{ config('site.phone') }} · {{ config('site.hours') }}
                </a>
            </div>
        </nav>
    </div>
</header>
