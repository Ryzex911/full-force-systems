{{--
    Mijn account: hier komt de bezoeker na het inloggen (route 'dashboard').
    Eenvoudige eerste versie; het volledige ontwerp "Mijn account" (bestellingen, aanvragen, adressen, favorieten) volgt nog.
--}}
@use('App\Support\Nav')

@extends('layouts.app')

@section('title', 'Mijn account')

@section('content')
    <x-page-header
        text="Welkom terug, {{ auth()->user()->name }}. Hier vindt u straks uw bestellingen, aanvragen en adressen."
        :crumbs="[['label' => 'Mijn account']]"
    >
        Mijn account
    </x-page-header>

    <section class="py-12 lg:py-16">
        <div class="wrap grid gap-6 md:grid-cols-2">
            <div class="card flex flex-col items-start gap-4 p-7 sm:p-8">
                <span class="icon-tile"><x-icon name="user" class="size-6" /></span>
                <h2 class="text-h3 text-ink">Uw gegevens</h2>
                <dl class="flex flex-col gap-3">
                    <div class="flex flex-col gap-0.5">
                        <dt class="text-label text-ink-3">Naam</dt>
                        <dd class="text-body text-ink">{{ auth()->user()->name }}</dd>
                    </div>
                    <div class="flex flex-col gap-0.5">
                        <dt class="text-label text-ink-3">E-mailadres</dt>
                        <dd class="text-body break-all text-ink">{{ auth()->user()->email }}</dd>
                    </div>
                </dl>
                <div class="mt-2 flex flex-wrap gap-3">
                    <x-button variant="secondary" :href="route('profile.edit')">Gegevens wijzigen</x-button>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-button type="submit">Uitloggen</x-button>
                    </form>
                </div>
            </div>

            <div class="card flex flex-col items-start gap-4 p-7 sm:p-8">
                <span class="icon-tile"><x-icon name="mail" class="size-6" /></span>
                <h2 class="text-h3 text-ink">Een vraag of offerte?</h2>
                <p class="text-body text-ink-2">Vraag vrijblijvend een offerte aan of bel ons op werkdagen. Wij nemen persoonlijk contact met u op.</p>
                <div class="mt-2 flex flex-wrap gap-3">
                    <x-button :href="Nav::quote()">Offerte aanvragen</x-button>
                    <x-button variant="secondary" :href="config('site.phone_href')">Bel {{ config('site.phone') }}</x-button>
                </div>
            </div>
        </div>
    </section>
@endsection
