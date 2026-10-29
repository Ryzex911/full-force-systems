{{--
    Kaart voor één dienst.
    Gebruik: <x-service-card icon="lock" title="Toegangscontrole" text="..." :href="route('diensten').'#toegangscontrole'" />
    Zonder href verschijnt er geen link "Meer informatie".
--}}
@props(['icon', 'title', 'text', 'href' => null])

<article {{ $attributes->merge(['class' => 'card flex flex-col gap-4 p-7']) }}>
    <span class="icon-tile">
        <x-icon :name="$icon" class="size-6" />
    </span>

    <h3 class="text-h4 text-ink">{{ $title }}</h3>
    <p class="text-body-sm text-ink-2">{{ $text }}</p>

    @if ($href)
        <x-button variant="link" :href="$href" class="mt-auto self-start" aria-label="Meer informatie over {{ strtolower($title) }}">Meer informatie</x-button>
    @endif
</article>
