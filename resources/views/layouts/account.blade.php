{{--
    Layout voor Mijn account (ontwerp 11): kop "Welkom, naam" met het accounttype, links het menu, rechts de pagina.
    Gebruik in een accountpagina:
        @extends('layouts.account')
        @section('title', 'Mijn bestellingen')
        @section('account')  ...inhoud...  @endsection
    Op mobiel staat het menu boven de inhoud, als een rij knoppen die je opzij kunt schuiven.
--}}
@extends('layouts.app')

@php
    $gebruiker = auth()->user();
    $zakelijk = $gebruiker->account_type === 'zakelijk';

    // Menu: [tekst, icoon, url, actief?]
    $menu = [
        ['Dashboard', 'home', route('account'), request()->routeIs('account')],
        ['Mijn bestellingen', 'box', route('account.bestellingen'), request()->routeIs('account.bestellingen')],
        ['Mijn aanvragen', 'file', route('account.aanvragen'), request()->routeIs('account.aanvragen')],
        ['Favorieten', 'heart', route('account.favorieten'), request()->routeIs('account.favorieten')],
        ['Adresboek', 'pin', route('account.adressen'), request()->routeIs('account.adressen')],
        ['Gegevens', 'user', route('profile.edit'), request()->routeIs('profile.edit')],
        ['Wachtwoord wijzigen', 'lock', route('profile.edit').'#wachtwoord', false],
    ];

    // Kruimelpad: op het dashboard alleen "Mijn account", op de andere pagina's ook de titel van de pagina
    $kruimels = request()->routeIs('account')
        ? [['label' => 'Mijn account']]
        : [['label' => 'Mijn account', 'url' => route('account')], ['label' => trim($__env->yieldContent('title'))]];
@endphp

@section('content')
    <x-page-header :crumbs="$kruimels">
        Welkom, {{ $gebruiker->name }}

        <x-slot:actions>
            <div class="flex flex-wrap items-center gap-3">
                <span class="text-label rounded-full bg-brand-soft px-3 py-1.5 text-brand-ink">{{ $zakelijk ? 'Zakelijk account' : 'Particulier account' }}</span>
                @if ($zakelijk && $gebruiker->company_name)
                    <span class="text-body-sm flex items-center gap-1.5 text-ink-2">
                        <x-icon name="building" class="size-4" />
                        {{ $gebruiker->company_name }}
                    </span>
                @endif
            </div>
        </x-slot:actions>
    </x-page-header>

    <section class="py-10 lg:py-16">
        <div class="wrap grid items-start gap-8 lg:grid-cols-[260px_1fr]">
            {{-- Menu --}}
            <nav class="relative -mx-4 overflow-x-auto px-4 sm:mx-0 sm:px-0 lg:sticky lg:top-36 lg:overflow-visible" aria-label="Mijn account">
                <ul class="flex gap-2 lg:flex-col lg:rounded-xl lg:border lg:border-line lg:bg-surface lg:gap-1 lg:p-3">
                    @foreach ($menu as [$tekst, $icoon, $url, $actief])
                        <li class="shrink-0">
                            <a
                                href="{{ $url }}"
                                class="text-body-sm flex items-center gap-3 rounded-lg px-4 py-2.5 font-medium whitespace-nowrap {{ $actief ? 'bg-brand-soft text-brand-ink' : 'border border-line text-ink-2 hover:bg-surface-2 hover:text-ink lg:border-transparent' }}"
                                @if ($actief) aria-current="page" @endif
                            >
                                <x-icon :name="$icoon" class="size-5" />
                                {{ $tekst }}
                            </a>
                        </li>
                    @endforeach
                    <li class="shrink-0">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-body-sm flex w-full items-center gap-3 rounded-lg border border-line px-4 py-2.5 font-medium whitespace-nowrap text-ink-2 hover:bg-surface-2 hover:text-ink lg:border-transparent">
                                <x-icon name="logout" class="size-5" />
                                Uitloggen
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <div class="flex min-w-0 flex-col gap-6">
                @yield('account')

                @unless (request()->routeIs('profile.edit'))
                    {{-- TODO: weghalen zodra bestellingen, aanvragen en adressen uit de database komen --}}
                    <p class="text-body-sm text-ink-3">Voorbeeldgegevens — bestellingen, aanvragen en adressen worden gekoppeld zodra de database er is. Favorieten worden nu bewaard zolang u op de site bent.</p>
                @endunless
            </div>
        </div>
    </section>
@endsection
