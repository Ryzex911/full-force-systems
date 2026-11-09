{{-- Mijn aanvragen: offerteaanvragen terugzien ($quotes, VOORBEELDDATA uit App\Support\ExampleAccount) --}}
@use('App\Support\Nav')

@extends('layouts.account')

@section('title', 'Mijn aanvragen')

@section('account')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div class="flex flex-col gap-1">
            <h2 class="text-h3 text-ink">Mijn aanvragen</h2>
            <p class="text-body-sm text-ink-2">Uw offerteaanvragen en de status ervan.</p>
        </div>
        <x-button :href="Nav::quote()">Nieuwe aanvraag</x-button>
    </div>

    @forelse ($quotes as $aanvraag)
        <article class="card flex flex-col gap-4 p-6 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-start gap-4">
                <span class="icon-tile shrink-0"><x-icon name="file" class="size-6" /></span>
                <div class="flex flex-col gap-1">
                    <h3 class="text-h4 text-ink">{{ $aanvraag['title'] }}</h3>
                    <p class="text-body-sm text-ink-2">{{ $aanvraag['service'] }} · aangevraagd op {{ $aanvraag['date'] }}</p>
                </div>
            </div>
            <x-status :status="$aanvraag['status']" class="self-start sm:self-center" />
        </article>
    @empty
        <div class="card flex flex-col items-start gap-4 p-6">
            <p class="text-body text-ink-2">U heeft nog geen offerte aangevraagd.</p>
            <x-button :href="Nav::quote()">Offerte aanvragen</x-button>
        </div>
    @endforelse
@endsection
