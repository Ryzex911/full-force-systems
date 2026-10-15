{{--
    Uitgelichte producten uit de webshop ($products uit HomeController, nu nog voorbeelddata).
    "Naar de webshop" verschijnt vanzelf zodra de route 'webshop' bestaat.
--}}
@use('App\Support\Nav')

<section id="webshop" class="scroll-mt-32 py-16 lg:py-24">
    <div class="wrap flex flex-col gap-12">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <x-section-heading label="Webshop" title="Zelf bestellen" text="Dezelfde producten die wij installeren, ook los te koop." />
            @if ($link = Nav::page('webshop'))
                <x-button variant="link" :href="$link">Naar de webshop</x-button>
            @endif
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($products as $product)
                <x-product-card
                    :icon="$product['icon']"
                    :category="$product['category']"
                    :title="$product['title']"
                    :price="$product['price']"
                    :image="$product['image']"
                />
            @endforeach
        </div>
    </div>
</section>
