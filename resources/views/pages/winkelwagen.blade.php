{{--
    Winkelwagen (/winkelwagen). Er is nog geen Figma-ontwerp; gebouwd in de huisstijl van de webshop.
    De inhoud staat in de sessie (App\Support\Cart). Gegevens uit CartController@index: $lines, $total, $quoteUrl.
    Afrekenen met iDEAL of bankoverschrijving komt later. Tot die tijd vraagt de bezoeker de inhoud aan als offerte.
--}}
@use('App\Support\Catalog')
@use('App\Support\Nav')

@extends('layouts.app')

@section('title', 'Winkelwagen')
@section('description', 'Uw winkelwagen bij Full Force Systems.')

@section('content')
    <x-page-header :crumbs="[['label' => 'Webshop', 'url' => route('webshop')], ['label' => 'Winkelwagen']]">
        Winkelwagen
    </x-page-header>

    <section class="py-12 lg:py-16">
        <div class="wrap">
            @if (! $lines)
                <div class="card flex flex-col items-center gap-4 px-6 py-14 text-center">
                    <span class="icon-tile size-14"><x-icon name="cart" class="size-7" /></span>
                    <h2 class="text-h3 text-ink">Uw winkelwagen is leeg</h2>
                    <p class="text-body max-w-[440px] text-ink-2">
                        Bekijk onze camera's, alarmsystemen en andere producten. Liever advies? Vraag een offerte aan.
                    </p>
                    <div class="flex flex-wrap justify-center gap-3">
                        <x-button :href="route('webshop')">Naar de webshop</x-button>
                        <x-button variant="secondary" :href="route('pakketten')">Pakketten bekijken</x-button>
                    </div>
                </div>
            @else
                <div class="grid items-start gap-8 lg:grid-cols-[1fr_380px]">
                    {{-- Producten --}}
                    <ul class="card divide-y divide-line">
                        @foreach ($lines as $regel)
                            @php
                                $product = $regel['product'];
                            @endphp
                            <li class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:gap-6 sm:p-6">
                                <a href="{{ route('webshop.show', $product['slug']) }}" class="flex size-20 shrink-0 items-center justify-center overflow-hidden rounded-lg bg-surface-2 text-ink-2" tabindex="-1" aria-hidden="true">
                                    @if ($product['image'])
                                        <img src="{{ $product['image'] }}" alt="" class="size-full object-cover">
                                    @else
                                        <x-icon :name="$product['icon']" class="size-9" />
                                    @endif
                                </a>

                                <div class="flex min-w-0 grow flex-col gap-1">
                                    <p class="text-label text-ink-3">{{ $product['category'] }}</p>
                                    <h2 class="text-h4 text-ink">
                                        <a href="{{ route('webshop.show', $product['slug']) }}" class="hover:underline">{{ $product['title'] }}</a>
                                    </h2>
                                    <p class="text-body-sm text-ink-2">{{ $product['price'] }} per stuk</p>
                                </div>

                                <div class="flex items-center justify-between gap-4 sm:justify-end">
                                    {{-- Aantal wijzigen: met JavaScript meteen, zonder JavaScript met de knop "Bijwerken" --}}
                                    <form method="POST" action="{{ route('winkelwagen.update', $product['slug']) }}" class="flex items-center gap-2" data-auto-verzenden>
                                        @csrf
                                        @method('PATCH')
                                        <x-quantity :id="'aantal-'.$product['slug']" :value="$regel['quantity']" :min="0" :label="'Aantal '.$product['title']" />
                                        <x-button type="submit" variant="link" data-zonder-js>Bijwerken</x-button>
                                    </form>

                                    <p class="text-h4 w-24 text-right text-ink">{{ Catalog::euro($regel['subtotal']) }}</p>

                                    <form method="POST" action="{{ route('winkelwagen.destroy', $product['slug']) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex size-10 items-center justify-center rounded-lg text-ink-3 hover:bg-surface-2 hover:text-brand-ink" aria-label="{{ $product['title'] }} verwijderen" title="Verwijderen">
                                            <x-icon name="trash" class="size-5" />
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    {{-- Overzicht --}}
                    <aside class="card flex flex-col gap-5 p-6 lg:sticky lg:top-36">
                        <h2 class="text-h3 text-ink">Overzicht</h2>

                        @error('aantal')
                            <p class="text-body-sm flex items-start gap-1.5 text-brand-ink">
                                <x-icon name="alert" class="mt-0.5 size-4" />
                                {{ $message }}
                            </p>
                        @enderror

                        <dl class="text-body-sm flex flex-col gap-3">
                            <div class="flex justify-between gap-4">
                                <dt class="text-ink-2">Subtotaal</dt>
                                <dd class="text-ink">{{ $total }}</dd>
                            </div>
                            <div class="flex justify-between gap-4">
                                <dt class="text-ink-2">Verzending</dt>
                                <dd class="text-ink-2">Volgt bij afrekenen</dd>
                            </div>
                            <div class="flex justify-between gap-4 border-t border-line pt-3">
                                <dt class="text-h4 text-ink">Totaal</dt>
                                <dd class="text-h4 text-ink">{{ $total }}</dd>
                            </div>
                        </dl>

                        {{-- TODO: knop "Afrekenen" (iDEAL / bankoverschrijving) zodra het afrekenen er is --}}
                        <div class="text-body-sm flex gap-3 rounded-lg bg-surface-2 p-4 text-ink-2">
                            <x-icon name="alert" class="size-5 text-ink-3" />
                            <p>Online afrekenen met iDEAL of bankoverschrijving komt binnenkort. Vraag uw producten nu aan; wij sturen u een voorstel.</p>
                        </div>

                        <x-button :href="$quoteUrl" class="w-full">Producten aanvragen</x-button>
                        <x-button variant="secondary" :href="route('webshop')" class="w-full">Verder winkelen</x-button>
                    </aside>
                </div>

                <p class="text-body-sm mt-6 text-ink-3">Voorbeeldproducten en -prijzen — het echte assortiment volgt van de opdrachtgever.</p>
            @endif
        </div>
    </section>
@endsection
