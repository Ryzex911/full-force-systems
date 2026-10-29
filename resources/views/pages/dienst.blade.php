{{--
    Detailpagina van één dienst, bijvoorbeeld /diensten/camerabewaking (ontwerp: docs/ontwerp/03-dienst-detail.png).
    Eén pagina voor alle vijf diensten. De secties staan in resources/views/pages/dienst/.
    De gegevens komen uit ServiceController@show: $service (uit config('site.services')) en $products (bijpassende producten).
--}}
@use('App\Support\Nav')

@extends('layouts.app')

@section('title', $service['title'])
@section('description', $service['intro'])

@section('content')
    <x-page-header
        :text="$service['intro']"
        :crumbs="[['label' => 'Diensten', 'url' => route('diensten')], ['label' => $service['title']]]"
    >
        {{ $service['title'] }}

        <x-slot:actions>
            <div class="flex flex-wrap gap-3">
                <x-button :href="route('pakketten')" data-kies-klant="particulier">Pakket bekijken</x-button>
                <x-button variant="secondary" :href="Nav::quote(['dienst' => $service['slug']])">Offerte aanvragen</x-button>
            </div>
            <p class="text-body-sm flex items-center gap-2 text-ink-3">
                <x-icon name="pin" class="size-4" />
                Werkgebied: {{ implode(' · ', config('site.regions')) }}
            </p>
        </x-slot:actions>

        <x-slot:media>
            @include('pages.dienst.beeld')
        </x-slot:media>
    </x-page-header>

    @include('pages.dienst.wat-u-krijgt')
    @include('pages.dienst.prijs')
    @include('partials.werkwijze')
    @include('pages.dienst.vragen')
    @include('pages.dienst.producten')

    @include('partials.cta', [
        'ctaFoto' => 'images/voorbeeld/kantoor.jpg',
        'ctaOfferte' => ['dienst' => $service['slug']],
    ])
@endsection
