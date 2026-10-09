{{--
    Productkaart voor de webshop.
    Zonder foto wordt het icoon van de categorie getoond.
    Gebruik: <x-product-card icon="camera" category="Camera's" title="..." price="€ 199,00" :image="$url" />
--}}
@props(['icon' => 'camera', 'category', 'title', 'price', 'image' => null, 'href' => '#'])

<article {{ $attributes->merge(['class' => 'card flex flex-col overflow-hidden']) }}>
    <a href="{{ $href }}" class="flex h-[200px] items-center justify-center bg-surface-2 text-ink-2" tabindex="-1" aria-hidden="true">
        @if ($image)
            <img src="{{ $image }}" alt="" class="size-full object-cover" loading="lazy">
        @else
            <x-icon :name="$icon" class="size-14" />
        @endif
    </a>

    <div class="flex grow flex-col gap-2.5 p-5">
        <p class="text-label text-ink-3">{{ $category }}</p>

        <h3 class="text-h4 text-ink">
            <a href="{{ $href }}" class="hover:underline">{{ $title }}</a>
        </h3>

        <div class="mt-auto flex items-center justify-between gap-3">
            <p class="text-[26px] leading-8 font-extrabold tracking-[-0.005em] text-ink">{{ $price }}</p>
            <p class="text-body-sm flex items-center gap-1.5 text-ok">
                <span class="size-2 rounded-full bg-ok"></span>
                Op voorraad
            </p>
        </div>

        <x-button class="w-full">In winkelwagen</x-button>
    </div>
</article>
