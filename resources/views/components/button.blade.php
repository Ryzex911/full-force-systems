{{--
    Knop of link in de huisstijl.
    Gebruik: <x-button href="#">Offerte aanvragen</x-button>
    Varianten: primary (rood), secondary (rand), on-image (wit, voor op een foto), link (rode tekst met pijl).
    Zonder href wordt het een <button>.
--}}
@props(['variant' => 'primary', 'href' => null])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-lg text-[15px] leading-5 font-semibold whitespace-nowrap transition-colors';

    $variants = [
        'primary' => 'bg-brand px-6 py-3.5 text-white hover:bg-brand-dark',
        'secondary' => 'border border-ink-3 px-6 py-3.5 text-ink hover:border-ink',
        'on-image' => 'border border-white px-6 py-3.5 text-white hover:bg-white/10',
        'link' => 'py-1 text-brand-ink hover:underline',
    ];

    $classes = $base.' '.$variants[$variant];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
        @if ($variant === 'link')
            <x-icon name="arrow" class="size-[18px]" />
        @endif
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
        @if ($variant === 'link')
            <x-icon name="arrow" class="size-[18px]" />
        @endif
    </button>
@endif
