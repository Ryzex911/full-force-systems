{{--
    Productkaart voor de webshop.
    Zonder foto wordt het icoon van de categorie getoond.
    Gebruik: <x-product-card :slug="$product['slug']" icon="camera" category="Camera's" title="..." price="€ 199,00" :image="$url" />
    De producten zelf staan in App\Support\Catalog::products().

    slug:     foto en titel linken naar de productpagina (/webshop/{slug}) en de knop zet het product in de winkelwagen.
    href:     een andere link voor foto en titel (meestal niet nodig, slug regelt het).
    in-stock: false toont "Niet op voorraad"; de bezoeker kan het product dan alleen aanvragen.
--}}
@use('App\Support\Nav')
@props(['slug' => null, 'icon' => 'camera', 'category', 'title', 'price', 'image' => null, 'href' => null, 'inStock' => true])

@php
    $href ??= $slug ? Nav::page('webshop.show', ['slug' => $slug]) : null;
    $winkelwagen = $slug && $inStock ? Nav::page('winkelwagen.store') : null;

    // Met href is de foto een link (a), zonder href een gewoon blok (div)
    $kader = $href ? 'a' : 'div';
@endphp

<article {{ $attributes->merge(['class' => 'card flex flex-col overflow-hidden']) }}>
    <{{ $kader }} @if ($href) href="{{ $href }}" tabindex="-1" aria-hidden="true" @endif class="flex h-[200px] items-center justify-center bg-surface-2 text-ink-2">
        @if ($image)
            <img src="{{ $image }}" alt="" class="size-full object-cover" loading="lazy">
        @else
            <x-icon :name="$icon" class="size-14" />
        @endif
    </{{ $kader }}>

    <div class="flex grow flex-col gap-2.5 p-5">
        <p class="text-label text-ink-3">{{ $category }}</p>

        <h3 class="text-h4 text-ink">
            @if ($href)
                <a href="{{ $href }}" class="hover:underline">{{ $title }}</a>
            @else
                {{ $title }}
            @endif
        </h3>

        <div class="mt-auto flex items-center justify-between gap-3">
            <p class="text-[26px] leading-8 font-extrabold tracking-[-0.005em] text-ink">{{ $price }}</p>
            @if ($inStock)
                <p class="text-body-sm flex items-center gap-1.5 text-ok">
                    <span class="size-2 rounded-full bg-ok"></span>
                    Op voorraad
                </p>
            @else
                <p class="text-body-sm flex items-center gap-1.5 text-ink-3">
                    <span class="size-2 rounded-full bg-ink-3"></span>
                    Niet op voorraad
                </p>
            @endif
        </div>

        @if ($winkelwagen)
            <form method="POST" action="{{ $winkelwagen }}">
                @csrf
                <input type="hidden" name="product" value="{{ $slug }}">
                <x-button type="submit" class="w-full" aria-label="{{ $title }} in winkelwagen">In winkelwagen</x-button>
            </form>
        @else
            <x-button :href="Nav::quote(['product' => $title])" class="w-full" aria-label="Product aanvragen: {{ $title }}">
                Product aanvragen
            </x-button>
        @endif
    </div>
</article>
