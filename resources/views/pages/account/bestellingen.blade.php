{{-- Mijn bestellingen ($orders, VOORBEELDDATA uit App\Support\ExampleAccount) --}}
@extends('layouts.account')

@section('title', 'Mijn bestellingen')

@section('account')
    <div class="card overflow-hidden">
        <div class="flex flex-col gap-1 px-5 py-5 sm:px-6">
            <h2 class="text-h3 text-ink">Mijn bestellingen</h2>
            <p class="text-body-sm text-ink-2">Hier ziet u wat u in de webshop heeft besteld en wat de status is.</p>
        </div>

        @if ($orders)
            @include('pages.account.bestellingen-tabel')
        @else
            <div class="flex flex-col items-start gap-4 border-t border-line px-5 py-8 sm:px-6">
                <p class="text-body text-ink-2">U heeft nog niets besteld.</p>
                <x-button :href="route('webshop')">Naar de webshop</x-button>
            </div>
        @endif
    </div>
@endsection
