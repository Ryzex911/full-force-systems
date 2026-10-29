{{--
    Kaart voor één pakket. Met featured krijgt de kaart een rode rand en het label "Meest gekozen".
    Gebruik: <x-package-card name="Plus" price="€ 1.499" text="..." :features="$lijst" featured />
    De pakketten zelf staan in App\Support\Catalog::packages().
    Standaard is de knop "Pakket kiezen" en gaat hij naar het offerteformulier met het pakket al ingevuld.
    Andere knop: button="Pakket bekijken" :href="route('pakketten')" (zo staat hij op de homepage).
--}}
@use('App\Support\Nav')
@props(['name', 'price', 'text', 'features' => [], 'featured' => false, 'href' => null, 'button' => 'Pakket kiezen'])

<article {{ $attributes->merge(['class' => 'flex flex-col gap-5 rounded-2xl bg-surface p-8 '.($featured ? 'border-2 border-brand' : 'border border-line')]) }}>
    <div class="flex items-center justify-between gap-3">
        <h3 class="text-h3 text-ink">{{ $name }}</h3>

        @if ($featured)
            <span class="text-label rounded-full bg-brand-soft px-3 py-1.5 text-brand-ink">Meest gekozen</span>
        @endif
    </div>

    <p class="text-body-sm text-ink-2">{{ $text }}</p>

    <p class="flex flex-wrap items-end gap-x-2">
        <span class="text-h1 text-ink">{{ $price }}</span>
        <span class="text-body-sm pb-1.5 text-ink-3">incl. installatie</span>
    </p>

    <x-check-list :items="$features" class="border-t border-line pt-5 text-ink" />

    <x-button
        :variant="$featured ? 'primary' : 'secondary'"
        :href="$href ?? Nav::quote(['pakket' => $name])"
        class="mt-auto w-full"
        aria-label="{{ $button }}: {{ $name }}"
    >{{ $button }}</x-button>
</article>
