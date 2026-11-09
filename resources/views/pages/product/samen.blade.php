{{-- Vaak samen gekocht ($related uit WebshopController@show) --}}
@if ($related)
    <section class="bg-alt py-16 lg:py-24">
        <div class="wrap flex flex-col gap-10">
            <x-section-heading label="Ook interessant" title="Vaak samen gekocht" />

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($related as $item)
                    <x-product-card
                        :slug="$item['slug']"
                        :icon="$item['icon']"
                        :category="$item['category']"
                        :title="$item['title']"
                        :price="$item['price']"
                        :image="$item['image']"
                        :in-stock="$item['in_stock']"
                    />
                @endforeach
            </div>
        </div>
    </section>
@endif
