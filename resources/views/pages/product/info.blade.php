{{--
    Tabbladen Beschrijving, Specificaties en Installatie.
    Met JavaScript (data-tabs in resources/js/app.js) is steeds één tabblad zichtbaar.
    Zonder JavaScript staan alle drie onder elkaar en springen de tabs naar het juiste blok.
--}}
@use('App\Support\Nav')

@php
    $tabs = ['beschrijving' => 'Beschrijving', 'specificaties' => 'Specificaties', 'installatie' => 'Installatie'];
@endphp

<section class="pb-16 lg:pb-24" data-tabs>
    <div class="wrap flex flex-col gap-8">
        <div class="relative overflow-x-auto border-b border-line">
            <div class="flex gap-8" data-tab-lijst aria-label="Productinformatie">
                @foreach ($tabs as $sleutel => $naam)
                    <a
                        href="#tab-{{ $sleutel }}"
                        id="tab-knop-{{ $sleutel }}"
                        data-tab="{{ $sleutel }}"
                        class="text-body-sm -mb-px border-b-2 border-transparent py-3 font-semibold whitespace-nowrap text-ink-3 hover:text-ink aria-selected:border-brand aria-selected:text-ink"
                    >{{ $naam }}</a>
                @endforeach
            </div>
        </div>

        {{-- Beschrijving: tekst en voordelen links, belangrijkste specificaties rechts --}}
        <div id="tab-beschrijving" data-tab-paneel="beschrijving" class="scroll-mt-36 grid gap-10 lg:grid-cols-2 lg:gap-14" aria-labelledby="tab-knop-beschrijving">
            <div class="flex flex-col gap-4">
                <h2 class="text-h3 text-ink">{{ $product['heading'] }}</h2>
                <p class="text-body text-ink-2">{{ $product['description'] }}</p>
                <x-check-list :items="$product['features']" />
            </div>

            @include('pages.product.specificaties')
        </div>

        {{-- Specificaties: de volledige tabel --}}
        <div id="tab-specificaties" data-tab-paneel="specificaties" class="scroll-mt-36 flex flex-col gap-4" aria-labelledby="tab-knop-specificaties">
            <h2 class="text-h3 text-ink">Specificaties</h2>
            <div class="max-w-[720px]">
                @include('pages.product.specificaties')
            </div>
        </div>

        {{-- Installatie --}}
        <div id="tab-installatie" data-tab-paneel="installatie" class="scroll-mt-36 flex flex-col items-start gap-4" aria-labelledby="tab-knop-installatie">
            <h2 class="text-h3 text-ink">Laten installeren door Full Force Systems</h2>
            <p class="text-body max-w-[720px] text-ink-2">
                U kunt dit product zelf plaatsen, maar wij doen het ook graag voor u. Onze monteur plaatst het product, stelt alles in
                en legt uit hoe het werkt. Wij werken in {{ implode(', ', array_slice(config('site.regions'), 0, -1)) }} en {{ last(config('site.regions')) }}.
            </p>
            <x-check-list :items="['Advies over de beste plek', 'Nette montage en aansluiting', 'Uitleg bij de oplevering']" />
            <x-button variant="secondary" :href="Nav::quote(['product' => $product['title']])">Offerte voor installatie</x-button>
        </div>

        {{-- TODO: weghalen zodra de echte productgegevens er zijn --}}
        <p class="text-body-sm text-ink-3">Voorbeeldproduct en -specificaties — echte productgegevens volgen van de opdrachtgever.</p>
    </div>
</section>
