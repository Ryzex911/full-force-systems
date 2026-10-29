{{--
    Kop boven een sectie: klein rood kopje, titel en eventueel een korte tekst.
    Gebruik: <x-section-heading label="Diensten" title="Onze diensten" text="Korte uitleg" />
--}}
@props(['label' => null, 'title', 'text' => null])

<div {{ $attributes->merge(['class' => 'flex flex-col gap-3']) }}>
    @if ($label)
        <p class="text-label text-brand-ink">{{ $label }}</p>
    @endif

    <h2 class="text-h2 max-w-[760px] text-ink">{{ $title }}</h2>

    @if ($text)
        <p class="text-body max-w-[640px] text-ink-2">{{ $text }}</p>
    @endif
</div>
