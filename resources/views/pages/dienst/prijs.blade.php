{{--
    Prijs: vaste prijs voor particulier, vanaf-prijs voor zakelijk (wensenformulier, vraag 7).
    De knoppen zetten ook de keuze particulier/zakelijk in de header (data-kies-klant, zie app.js).
--}}
@use('App\Support\Nav')

<section class="pb-16 lg:pb-24">
    <div class="wrap flex flex-col gap-10">
        <x-section-heading label="Prijs" title="Duidelijk vooraf wat het kost" />

        <div class="grid gap-6 md:grid-cols-2">
            <div class="card flex flex-col items-start gap-4 p-7 sm:p-8">
                <p class="text-label text-brand-ink">Particulier</p>
                <p class="flex flex-wrap items-baseline gap-x-2.5">
                    <span class="text-h2 text-ink">Vaste prijs</span>
                    <span class="text-body-sm text-ink-3">{{ $service['price_note'] }}</span>
                </p>
                <p class="text-body text-ink-2">U kiest een pakket en weet direct waar u aan toe bent. Aanpassen kan altijd.</p>
                <x-button :href="route('pakketten')" class="mt-2" data-kies-klant="particulier">Pakket bekijken</x-button>
            </div>

            <div class="card flex flex-col items-start gap-4 p-7 sm:p-8">
                <p class="text-label text-brand-ink">Zakelijk</p>
                <p class="flex flex-wrap items-baseline gap-x-2.5">
                    <span class="text-h2 text-ink">Vanaf-prijs</span>
                    <span class="text-body-sm text-ink-3">op basis van uw pand</span>
                </p>
                <p class="text-body text-ink-2">Na een bezoek op locatie ontvangt u een voorstel op maat met een heldere vanaf-prijs.</p>
                <x-button variant="secondary" :href="Nav::quote(['dienst' => $service['slug'], 'klant' => 'zakelijk'])" class="mt-2" data-kies-klant="zakelijk">Offerte aanvragen</x-button>
            </div>
        </div>
    </div>
</section>
