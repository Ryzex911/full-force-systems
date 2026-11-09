{{--
    Mijn account – dashboard (ontwerp 11). Gegevens uit AccountController@index:
    $stats (drie tellers), $orders, $latestQuote en $address (VOORBEELDDATA, zie App\Support\ExampleAccount).
--}}
@extends('layouts.account')

@section('title', 'Mijn account')

@section('account')
    {{-- Tellers --}}
    <div class="grid gap-4 sm:grid-cols-3">
        @foreach ($stats as $teller)
            {{-- Op mobiel compact (tekst links, getal rechts), vanaf sm groot onder elkaar zoals in het ontwerp --}}
            <a href="{{ $teller['url'] }}" class="card flex items-center justify-between gap-2 px-5 py-4 hover:border-ink-3 sm:flex-col sm:items-start sm:justify-start sm:p-6">
                <span class="text-label text-ink-3">{{ $teller['label'] }}</span>
                <span class="text-h2 text-ink sm:text-display">{{ $teller['value'] }}</span>
            </a>
        @endforeach
    </div>

    {{-- Recente bestellingen --}}
    <div class="card overflow-hidden">
        <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-5 sm:px-6">
            <h2 class="text-h4 text-ink">Recente bestellingen</h2>
            <x-button variant="link" :href="route('account.bestellingen')">Alle bestellingen</x-button>
        </div>
        @include('pages.account.bestellingen-tabel')
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        {{-- Laatste aanvraag --}}
        <div class="card flex flex-col items-start gap-3 p-6">
            <p class="text-label text-ink-3">Laatste aanvraag</p>
            @if ($latestQuote)
                <h2 class="text-h4 text-ink">{{ $latestQuote['title'] }}</h2>
                <p class="text-body-sm text-ink-2">Aangevraagd op {{ $latestQuote['date'] }}</p>
                <x-status :status="$latestQuote['status']" />
                <x-button variant="link" :href="route('account.aanvragen')" class="mt-auto">Bekijk aanvragen</x-button>
            @else
                <h2 class="text-h4 text-ink">Nog geen aanvragen</h2>
                <x-button variant="link" :href="App\Support\Nav::quote()">Offerte aanvragen</x-button>
            @endif
        </div>

        {{-- Standaardadres --}}
        <div class="card flex flex-col items-start gap-3 p-6">
            <p class="text-label text-ink-3">Standaardadres</p>
            @if ($address)
                <h2 class="text-h4 text-ink">{{ $address['name'] }}</h2>
                <p class="text-body-sm text-ink-2">
                    @foreach ($address['lines'] as $regel)
                        {{ $regel }}@unless ($loop->last)<br>@endunless
                    @endforeach
                </p>
                <x-button variant="link" :href="route('account.adressen')" class="mt-auto">Adressen bekijken</x-button>
            @else
                <h2 class="text-h4 text-ink">Nog geen adres</h2>
            @endif
        </div>
    </div>
@endsection
