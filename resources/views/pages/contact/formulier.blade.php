{{--
    Offerteformulier met de velden uit het wensenformulier (vraag 11).
    Na het versturen zet ContactController 'verzonden' in de sessie; dan tonen we een bedankje in plaats van het formulier.
    De keuze particulier/zakelijk loopt gelijk met de knop in de header (zie resources/js/app.js).
--}}
@php
    // Particulier of zakelijk: eerst wat de bezoeker net invulde, dan de keuze uit de url (?klant=zakelijk).
    // Staat er niets vast, dan kiest app.js de keuze uit de header.
    $klanttype = old('klanttype', $prefill['klanttype']);
@endphp

<div id="offerteformulier" class="card scroll-mt-32 p-6 sm:p-10">
    @if (session('verzonden'))
        <div class="flex flex-col items-start gap-5" role="status">
            <span class="flex size-14 items-center justify-center rounded-full bg-ok-soft text-ok">
                <x-icon name="check-circle" class="size-8" />
            </span>
            <h2 class="text-h2 text-ink">Bedankt voor uw aanvraag</h2>
            <p class="text-body max-w-[560px] text-ink-2">
                Wij hebben uw aanvraag ontvangen en sturen u een bevestiging per e-mail. Wij bekijken uw situatie en nemen persoonlijk contact met u op.
            </p>
            <div class="flex flex-wrap gap-3">
                <x-button :href="route('home')">Naar de homepage</x-button>
                <x-button variant="secondary" :href="route('diensten')">Bekijk onze diensten</x-button>
            </div>
        </div>
    @else
        <div class="mb-8 flex flex-col gap-3">
            <p class="text-label text-brand-ink">Offerte aanvragen</p>
            <h2 class="text-h2 text-ink">Vertel ons wat u wilt beveiligen</h2>
            <p class="text-body text-ink-2">Velden zonder "(optioneel)" zijn verplicht. U zit nergens aan vast.</p>
        </div>

        @if (session('mislukt'))
            <div class="mb-6 flex items-start gap-3 rounded-lg border border-brand-ink bg-brand-soft p-4 text-ink" role="alert">
                <x-icon name="alert" class="mt-0.5 size-5 text-brand-ink" />
                <p class="text-body-sm">
                    Het versturen is helaas niet gelukt. Probeer het opnieuw, of bel ons op
                    <a href="{{ config('site.phone_href') }}" class="font-semibold underline">{{ config('site.phone') }}</a>.
                </p>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 flex items-start gap-3 rounded-lg border border-brand-ink bg-brand-soft p-4 text-ink" role="alert">
                <x-icon name="alert" class="mt-0.5 size-5 text-brand-ink" />
                <p class="text-body-sm">
                    Niet alles is goed ingevuld. Bekijk de {{ $errors->count() === 1 ? 'melding' : $errors->count().' meldingen' }} hieronder.
                </p>
            </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" class="flex flex-col gap-6" novalidate>
            @csrf

            {{-- Particulier of zakelijk --}}
            <fieldset class="flex flex-col gap-2" @if ($klanttype) data-klant-vast="{{ $klanttype }}" @endif>
                <legend class="text-body-sm mb-2 font-semibold text-ink">Ik vraag een offerte aan als</legend>
                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach (['particulier' => ['home', 'Particulier', 'Voor mijn woning'], 'zakelijk' => ['building', 'Zakelijk', 'Voor mijn bedrijf']] as $waarde => [$icoon, $titel, $tekst])
                        <label class="flex cursor-pointer items-center gap-4 rounded-xl border border-line bg-page p-4 transition-colors hover:border-ink-3 has-checked:border-brand has-checked:bg-brand-soft has-focus-visible:outline-2 has-focus-visible:outline-brand-ink">
                            <input type="radio" name="klanttype" value="{{ $waarde }}" class="sr-only" @checked($klanttype === $waarde) required>
                            <span class="icon-tile size-11">
                                <x-icon :name="$icoon" class="size-[22px]" />
                            </span>
                            <span class="flex flex-col">
                                <span class="text-h4 text-ink">{{ $titel }}</span>
                                <span class="text-body-sm text-ink-2">{{ $tekst }}</span>
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('klanttype')
                    <p class="text-body-sm flex items-start gap-1.5 text-brand-ink">
                        <x-icon name="alert" class="mt-0.5 size-4" />
                        {{ $message }}
                    </p>
                @enderror
            </fieldset>

            <div class="grid gap-6 sm:grid-cols-2">
                <x-field name="naam" label="Naam" required autocomplete="name" />
                <x-field name="bedrijfsnaam" label="Bedrijfsnaam" hint="Alleen nodig als u zakelijk aanvraagt." autocomplete="organization" />
                <x-field name="email" label="E-mailadres" type="email" required autocomplete="email" />
                <x-field name="telefoon" label="Telefoonnummer" type="tel" autocomplete="tel" />
                <x-field name="postcode_plaats" label="Postcode en plaats" placeholder="Bijvoorbeeld 6534 AJ Nijmegen" autocomplete="postal-code" />
                <x-field name="dienst" label="Gewenste dienst" type="select" :options="$services" :value="$prefill['dienst']" placeholder="Weet ik nog niet / advies" />
            </div>

            <x-field name="producten" label="Product(en)" :value="$prefill['producten']" placeholder="Bijvoorbeeld een pakket of product uit de webshop" />
            <x-field name="omschrijving" label="Omschrijving" type="textarea" required placeholder="Wat wilt u beveiligen? Denk aan het soort pand, het aantal ingangen of wat u nu al heeft." />

            {{-- Tegen spam: dit veld is onzichtbaar voor bezoekers. Alleen robots vullen het in. --}}
            <div class="hidden" aria-hidden="true">
                <label for="veld-website">Laat dit veld leeg</label>
                <input type="text" id="veld-website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="flex flex-col gap-4 border-t border-line pt-6 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-body-sm max-w-[420px] text-ink-3">
                    Wij gebruiken uw gegevens alleen om uw aanvraag te beantwoorden.
                </p>
                <x-button type="submit" class="shrink-0">Aanvraag versturen</x-button>
            </div>
        </form>
    @endif
</div>
