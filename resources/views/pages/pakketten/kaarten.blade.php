{{-- De drie pakketkaarten ($packages uit PackageController, nu nog voorbeelddata) --}}
<section class="py-12 lg:py-20" aria-label="Pakketten">
    <div class="wrap flex flex-col gap-8">
        <div class="grid gap-6 lg:grid-cols-3 lg:items-end">
            @foreach ($packages as $pakket)
                <x-package-card
                    :name="$pakket['name']"
                    :price="$pakket['price']"
                    :text="$pakket['text']"
                    :features="$pakket['features']"
                    :featured="$pakket['featured']"
                />
            @endforeach
        </div>

        {{-- TODO: deze regel weghalen zodra de echte pakketten en prijzen bekend zijn --}}
        <p class="text-body-sm text-ink-3">Voorbeeldprijzen en -inhoud — definitieve pakketten volgen van de opdrachtgever.</p>
    </div>
</section>
