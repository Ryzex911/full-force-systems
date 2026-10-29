{{--
    Rechterkant van de webshop: werkbalk (zoeken, aantal, sorteren), de producten en de paginering.
    $products is een paginator: $products->total() is het aantal na filteren, foreach geeft de producten van deze pagina.
--}}
@use('App\Support\Nav')

<div class="flex min-w-0 flex-col gap-6">
    {{-- Werkbalk --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="w-full sm:max-w-[300px]">
            <x-field name="zoek" label="Zoek producten" type="search" size="sm" icon="search" :hide-label="true" :value="$filters['zoek']" placeholder="Zoek producten…" />
        </div>

        <div class="flex items-center justify-between gap-4 sm:justify-end">
            <p class="text-body-sm text-ink-3" aria-live="polite">
                {{ $products->total() }} {{ $products->total() === 1 ? 'product' : 'producten' }}
            </p>
            <x-field name="sorteer" label="Sorteren" type="select" size="sm" :hide-label="true" :options="$sortOptions" :value="$filters['sorteer']" :placeholder="false" />
        </div>
    </div>

    @if ($products->isEmpty())
        <div class="card flex flex-col items-center gap-4 px-6 py-14 text-center">
            <span class="icon-tile size-14"><x-icon name="search" class="size-7" /></span>
            <h2 class="text-h3 text-ink">Geen producten gevonden</h2>
            <p class="text-body max-w-[440px] text-ink-2">
                Probeer een andere zoekterm of categorie. Weet u niet wat u nodig heeft? Wij geven graag advies.
            </p>
            <div class="flex flex-wrap justify-center gap-3">
                <x-button :href="route('webshop')">Alle producten tonen</x-button>
                <x-button variant="secondary" :href="Nav::quote()">Advies vragen</x-button>
            </div>
        </div>
    @else
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($products as $product)
                <x-product-card
                    :icon="$product['icon']"
                    :category="$product['category']"
                    :title="$product['title']"
                    :price="$product['price']"
                    :image="$product['image']"
                    :in-stock="$product['in_stock']"
                />
            @endforeach
        </div>

        @include('partials.paginering', ['paginator' => $products])
    @endif

    {{-- TODO: weghalen zodra de echte producten en prijzen bekend zijn --}}
    <p class="text-body-sm text-ink-3">Voorbeeldproducten en -prijzen — het echte assortiment volgt van de opdrachtgever.</p>
</div>
