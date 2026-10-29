{{--
    Bijpassende producten ($products uit ServiceController, gekozen met $service['products'] in config/site.php).
    "Naar de webshop" opent de webshop met de categorie van het eerste product al gekozen.
--}}
@if ($products)
    <section class="pb-16 lg:pb-24">
        <div class="wrap flex flex-col gap-10">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <x-section-heading label="Webshop" title="Bijpassende producten" />
                <x-button variant="link" :href="route('webshop', ['categorie' => $products[0]['category_slug']])">Naar de webshop</x-button>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
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
        </div>
    </section>
@endif
