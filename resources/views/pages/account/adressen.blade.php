{{-- Adresboek ($addresses, VOORBEELDDATA uit App\Support\ExampleAccount). Adressen toevoegen en wijzigen komt met de database. --}}
@extends('layouts.account')

@section('title', 'Adresboek')

@section('account')
    <div class="flex flex-col gap-1">
        <h2 class="text-h3 text-ink">Adresboek</h2>
        <p class="text-body-sm text-ink-2">Het adres voor levering en installatie.</p>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        @foreach ($addresses as $adres)
            <article class="card flex flex-col items-start gap-3 p-6">
                <div class="flex w-full items-center justify-between gap-3">
                    <p class="text-label text-ink-3">{{ $adres['label'] }}</p>
                    @if ($adres['default'])
                        <span class="text-caption rounded-full bg-brand-soft px-2.5 py-1 font-semibold text-brand-ink">Standaard</span>
                    @endif
                </div>
                <h3 class="text-h4 text-ink">{{ $adres['name'] }}</h3>
                <p class="text-body-sm text-ink-2">
                    @foreach ($adres['lines'] as $regel)
                        {{ $regel }}@unless ($loop->last)<br>@endunless
                    @endforeach
                </p>
            </article>
        @endforeach

        {{-- TODO: knop "Adres toevoegen" met formulier zodra adressen in de database worden opgeslagen --}}
        <div class="flex flex-col items-start justify-center gap-3 rounded-xl border border-dashed border-line p-6">
            <span class="icon-tile"><x-icon name="plus" class="size-6" /></span>
            <p class="text-body-sm text-ink-2">Adressen toevoegen en wijzigen kan binnenkort. Wilt u nu iets wijzigen? Bel ons op <a href="{{ config('site.phone_href') }}" class="text-brand-ink hover:underline">{{ config('site.phone') }}</a>.</p>
        </div>
    </div>
@endsection
