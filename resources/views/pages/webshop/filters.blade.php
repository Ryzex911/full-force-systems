{{--
    Filters links in de webshop: categorieën (links), prijs en beschikbaarheid (velden in het formulier).
    Op mobiel staan de filters in een uitklapblok "Filters" boven de producten; op desktop is het altijd open.
--}}
@use('Illuminate\Support\Arr')

@php
    // Link naar een categorie, met behoud van de andere filters (zoeken, prijs, sorteren). Paginering begint opnieuw.
    $categorieLink = fn (?string $slug) => route('webshop', $slug ? array_merge($query, ['categorie' => $slug]) : Arr::except($query, 'categorie'));
@endphp

<aside aria-label="Filters">
    <details open class="group" data-filters @if ($hasFilters) data-actief @endif>
        <summary class="text-body flex cursor-pointer list-none items-center justify-between rounded-lg border border-line bg-surface px-4 py-3 font-semibold text-ink lg:hidden [&::-webkit-details-marker]:hidden">
            <span class="flex items-center gap-2">
                Filters
                @if ($hasFilters)
                    <span class="text-caption rounded-full bg-brand-soft px-2 py-0.5 text-brand-ink">actief</span>
                @endif
            </span>
            <x-icon name="plus" class="size-5 text-ink-3 transition-transform group-open:rotate-45" />
        </summary>

        <div class="flex flex-col gap-8 pt-6 lg:pt-0">
            {{-- Categorieën --}}
            <nav aria-label="Categorieën" class="flex flex-col gap-3">
                <h2 class="text-label text-ink">Categorieën</h2>
                <ul class="flex flex-col gap-1">
                    @foreach (['' => 'Alle producten'] + array_map(fn ($c) => $c['label'], $categories) as $slug => $label)
                        @php $actief = ($filters['categorie'] ?? '') === $slug; @endphp
                        <li>
                            <a
                                href="{{ $categorieLink($slug ?: null) }}"
                                class="text-body-sm block rounded-lg px-2.5 py-2 transition-colors {{ $actief ? 'bg-brand-soft font-semibold text-brand-ink' : 'text-ink-2 hover:bg-surface-2 hover:text-ink' }}"
                                @if ($actief) aria-current="true" @endif
                            >{{ $label }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            {{-- Prijs --}}
            <fieldset class="flex flex-col gap-3">
                <legend class="text-label mb-3 text-ink">Prijs</legend>
                <div class="grid grid-cols-2 gap-3">
                    <x-field name="prijs_van" label="Van" type="number" size="sm" :mark-optional="false" :value="$query['prijs_van'] ?? null" placeholder="€ 0" min="0" step="1" inputmode="numeric" />
                    <x-field name="prijs_tot" label="Tot" type="number" size="sm" :mark-optional="false" :value="$query['prijs_tot'] ?? null" placeholder="€ 500" min="0" step="1" inputmode="numeric" />
                </div>
            </fieldset>

            {{-- Beschikbaarheid --}}
            <fieldset class="flex flex-col gap-3">
                <legend class="text-label mb-3 text-ink">Beschikbaarheid</legend>
                @foreach (['voorraad' => 'Alleen op voorraad', 'aanbieding' => 'Aanbiedingen'] as $naam => $label)
                    <label class="text-body-sm flex cursor-pointer items-center gap-2.5 text-ink-2 hover:text-ink">
                        <input type="checkbox" name="{{ $naam }}" value="1" class="size-4 rounded accent-brand" @checked($filters[$naam])>
                        {{ $label }}
                    </label>
                @endforeach
            </fieldset>

            {{-- Zonder JavaScript is deze knop nodig om de prijs en de vinkjes toe te passen; app.js verbergt hem --}}
            <div class="flex flex-col gap-3" data-zonder-js>
                <x-button type="submit" variant="secondary" class="w-full">Filters toepassen</x-button>
            </div>

            @if ($hasFilters)
                <a href="{{ route('webshop') }}" class="text-body-sm self-start text-brand-ink hover:underline">Alle filters wissen</a>
            @endif
        </div>
    </details>

    {{-- Op mobiel het filterblok dicht laten beginnen (behalve als er al filters actief zijn). Staat hier, zodat het niet knippert. --}}
    <script>
        (function () {
            var blok = document.currentScript.previousElementSibling;
            if (window.matchMedia('(max-width: 1023px)').matches && !blok.hasAttribute('data-actief')) blok.open = false;
        })();
    </script>
</aside>
