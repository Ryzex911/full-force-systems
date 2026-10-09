{{--
    Kaart voor één dienst.
    Gebruik: <x-service-card icon="lock" title="Toegangscontrole" text="..." href="#" />
--}}
@props(['icon', 'title', 'text', 'href' => '#'])

<article {{ $attributes->merge(['class' => 'card flex flex-col gap-4 p-7']) }}>
    <span class="icon-tile">
        <x-icon :name="$icon" class="size-6" />
    </span>

    <h3 class="text-h4 text-ink">{{ $title }}</h3>
    <p class="text-body-sm text-ink-2">{{ $text }}</p>

    <x-button variant="link" :href="$href" class="mt-auto self-start">Meer informatie</x-button>
</article>
