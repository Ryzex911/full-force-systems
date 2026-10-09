{{-- Uitgelichte producten uit de webshop ($products uit HomeController, nu nog voorbeelddata) --}}
<section id="webshop" class="scroll-mt-32 py-16 lg:py-24">
    <div class="wrap flex flex-col gap-12">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <x-section-heading label="Webshop" title="Zelf bestellen" text="Dezelfde producten die wij installeren, ook los te koop." />
            <x-button variant="link" href="#">Naar de webshop</x-button>
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
