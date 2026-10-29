{{--
    Voor wie: thuis of bedrijf ($audiences uit ServiceController).
    De kaart die past bij de keuze particulier/zakelijk in de header krijgt een rode rand.
--}}
<section class="bg-alt py-16 lg:py-24">
    <div class="wrap flex flex-col gap-12">
        <x-section-heading
            label="Voor wie"
            title="Thuis of op de zaak: wij regelen het"
            text="Dezelfde producten en dezelfde kwaliteit. Alleen de route is anders."
        />

        <div class="grid gap-6 lg:grid-cols-2">
            @foreach ($audiences as $nummer => $doelgroep)
                {{-- De eerste kaart is voor particulier, de tweede voor zakelijk --}}
                <article class="flex flex-col items-start gap-[18px] rounded-2xl border bg-surface p-7 sm:p-10 {{ $nummer === 0 ? 'border-brand zakelijk:border-line' : 'border-line zakelijk:border-brand' }}">
                    <span class="icon-tile">
                        <x-icon :name="$doelgroep['icon']" class="size-6" />
                    </span>

                    <h3 class="text-h3 text-ink">{{ $doelgroep['title'] }}</h3>
                    <p class="text-body text-ink-2">{{ $doelgroep['text'] }}</p>
                    <x-check-list :items="$doelgroep['points']" class="text-ink" />

                    <x-button :variant="$doelgroep['variant']" :href="$doelgroep['href']" class="mt-auto" data-kies-klant="{{ $nummer === 0 ? 'particulier' : 'zakelijk' }}">{{ $doelgroep['button'] }}</x-button>
                </article>
            @endforeach
        </div>
    </div>
</section>
