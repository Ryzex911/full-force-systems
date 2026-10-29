{{--
    Kaart voor één project.
    Gebruik: <x-project-card tag="Camera + alarm" title="..." location="Beuningen" :image="$url" alt="..." />
    href: link naar de projectpagina (zodra die bestaat). Zonder href is de titel geen link.
--}}
@props(['tag', 'title', 'location', 'image', 'alt' => '', 'href' => null])

<article {{ $attributes->merge(['class' => 'card flex flex-col overflow-hidden']) }}>
    <div class="h-60 bg-surface-2">
        <img src="{{ $image }}" alt="{{ $alt }}" class="size-full object-cover" loading="lazy">
    </div>

    <div class="flex flex-col gap-2 p-6">
        <p class="text-label text-brand-ink">{{ $tag }}</p>

        <h3 class="text-h4 text-ink">
            @if ($href)
                <a href="{{ $href }}" class="hover:underline">{{ $title }}</a>
            @else
                {{ $title }}
            @endif
        </h3>

        <p class="text-body-sm flex items-center gap-1.5 text-ink-2">
            <x-icon name="pin" class="size-4" />
            {{ $location }}
        </p>
    </div>
</article>
