{{--
    Kaart voor één pakket. Met featured krijgt de kaart een rode rand en het label "Meest gekozen".
    Gebruik: <x-package-card name="Plus" price="€ 1.499" text="..." :features="$lijst" featured />
--}}
@props(['name', 'price', 'text', 'features' => [], 'featured' => false, 'href' => '#'])

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

    <ul class="flex flex-col gap-2.5 border-t border-line pt-5">
        @foreach ($features as $feature)
            <li class="text-body-sm flex items-start gap-2.5 text-ink">
                <x-icon name="check" class="size-5 text-brand-ink" />
                {{ $feature }}
            </li>
        @endforeach
    </ul>

    <x-button :variant="$featured ? 'primary' : 'secondary'" :href="$href" class="mt-auto w-full">Pakket bekijken</x-button>
</article>
