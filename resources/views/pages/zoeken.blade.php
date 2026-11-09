{{--
    Zoeken op de hele site (/zoeken?q=...). Er is geen Figma-ontwerp; gebouwd in de huisstijl.
    Gegevens uit SearchController: $q (zoekterm), $groups (resultaten per soort), $total en $suggestions.
--}}
@use('App\Support\Nav')

@extends('layouts.app')

@section('title', $q !== '' ? 'Zoeken: '.$q : 'Zoeken')
@section('description', 'Zoek in de producten, diensten, pakketten en projecten van Full Force Systems.')

@section('content')
    <x-page-header :crumbs="[['label' => 'Zoeken']]">
        @if ($q !== '')
            Zoekresultaten
        @else
            Zoeken
        @endif

        <x-slot:actions>
            <form method="GET" action="{{ route('zoeken') }}" role="search" class="flex w-full max-w-[560px] flex-col gap-3 sm:flex-row">
                <div class="grow">
                    <x-field name="q" label="Waar zoekt u naar?" type="search" icon="search" :hide-label="true" :value="$q" placeholder="Bijvoorbeeld: camera, alarm, recorder" autofocus />
                </div>
                <x-button type="submit">Zoeken</x-button>
            </form>
        </x-slot:actions>
    </x-page-header>

    <section class="py-12 lg:py-16">
        <div class="wrap flex flex-col gap-12">
            @if ($q === '')
                <div class="flex flex-col gap-4">
                    <h2 class="text-h3 text-ink">Veel gezocht</h2>
                    <ul class="flex flex-wrap gap-3">
                        @foreach ($suggestions as $suggestie)
                            <li>
                                <a href="{{ route('zoeken', ['q' => $suggestie]) }}" class="text-body-sm inline-flex rounded-full border border-line px-4 py-2 text-ink hover:border-ink-3">{{ $suggestie }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @elseif ($total === 0)
                <div class="card flex flex-col items-center gap-4 px-6 py-14 text-center">
                    <span class="icon-tile size-14"><x-icon name="search" class="size-7" /></span>
                    <h2 class="text-h3 text-ink">Geen resultaten voor "{{ $q }}"</h2>
                    <p class="text-body max-w-[460px] text-ink-2">
                        Controleer de spelling of probeer een ander woord. Weet u niet wat u nodig heeft? Wij geven graag advies.
                    </p>
                    <div class="flex flex-wrap justify-center gap-3">
                        <x-button :href="route('webshop')">Naar de webshop</x-button>
                        <x-button variant="secondary" :href="Nav::quote()">Advies vragen</x-button>
                    </div>
                </div>
            @else
                <p class="text-body text-ink-2" aria-live="polite">
                    {{ $total }} {{ $total === 1 ? 'resultaat' : 'resultaten' }} voor <strong class="text-ink">"{{ $q }}"</strong>
                </p>

                @foreach ($groups as $sleutel => $groep)
                    <div class="flex flex-col gap-6">
                        <h2 class="text-h3 text-ink">{{ $groep['title'] }} <span class="text-ink-3">({{ count($groep['items']) }})</span></h2>

                        @if ($sleutel === 'producten')
                            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                @foreach ($groep['items'] as $product)
                                    <x-product-card
                                        :slug="$product['slug']"
                                        :icon="$product['icon']"
                                        :category="$product['category']"
                                        :title="$product['title']"
                                        :price="$product['price']"
                                        :image="$product['image']"
                                        :in-stock="$product['in_stock']"
                                    />
                                @endforeach
                            </div>
                        @else
                            <ul class="grid gap-4 md:grid-cols-2">
                                @foreach ($groep['items'] as $resultaat)
                                    <li>
                                        <a href="{{ $resultaat['url'] }}" class="card flex h-full items-start gap-4 p-5 hover:border-ink-3">
                                            <span class="icon-tile shrink-0"><x-icon :name="$resultaat['icon']" class="size-6" /></span>
                                            <span class="flex min-w-0 flex-col gap-1">
                                                <span class="text-label text-ink-3">{{ $resultaat['label'] }}</span>
                                                <span class="text-h4 text-ink">{{ $resultaat['title'] }}</span>
                                                <span class="text-body-sm text-ink-2">{{ $resultaat['text'] }}</span>
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endsection
