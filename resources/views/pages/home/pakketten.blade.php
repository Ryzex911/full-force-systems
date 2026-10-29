{{-- Pakketten voor particulieren ($packages uit HomeController, nu nog voorbeelddata) --}}
<section id="pakketten" class="scroll-mt-32 bg-alt py-16 lg:py-24">
    <div class="wrap flex flex-col gap-12">
        <x-section-heading
            label="Pakketten voor thuis"
            title="Kant-en-klaar beveiligd voor een vaste prijs"
            text="Een compleet pakket inclusief installatie. Zakelijk? Dan maken we een voorstel op maat."
        />

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
        <p class="text-body-sm text-ink-3">Voorbeeldprijzen — definitieve pakketten en prijzen volgen van de opdrachtgever.</p>
    </div>
</section>
