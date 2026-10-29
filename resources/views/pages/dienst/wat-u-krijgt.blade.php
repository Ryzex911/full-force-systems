{{-- Wat u krijgt: drie kaarten zonder link ($service['benefits'] uit config/site.php) --}}
<section class="py-16 lg:py-24">
    <div class="wrap flex flex-col gap-10">
        <x-section-heading label="Wat u krijgt" title="Van eerste advies tot uitleg bij oplevering" />

        <div class="grid gap-6 md:grid-cols-3">
            @foreach ($service['benefits'] as $voordeel)
                <x-service-card :icon="$voordeel['icon']" :title="$voordeel['title']" :text="$voordeel['text']" />
            @endforeach
        </div>

        @if ($service['example'])
            {{-- TODO: weghalen zodra de opdrachtgever de teksten van deze dienst heeft nagelezen --}}
            <p class="text-body-sm text-ink-3">Voorbeeldtekst — wordt nog nagelezen door de opdrachtgever.</p>
        @endif
    </div>
</section>
