{{--
    Foto rechts in de kop, met hoekjes zoals in een camerazoeker. Zonder foto tonen we het grote icoon van de dienst.
--}}
@php
    // Wit op een foto; zonder foto grijs, zodat de hoekjes ook in het lichte thema zichtbaar zijn
    $hoek = $service['image'] ? 'border-white/80' : 'border-ink-3/60';
@endphp

<div class="relative aspect-[540/400] overflow-hidden rounded-2xl border border-line bg-surface-2 text-ink-3">
    @if ($service['image'])
        <img src="{{ asset($service['image']) }}" alt="" class="absolute inset-0 size-full object-cover" fetchpriority="high">
    @else
        <div class="flex size-full items-center justify-center">
            <x-icon :name="$service['icon']" class="size-24" />
        </div>
    @endif

    {{-- Hoekjes (alleen versiering) --}}
    <span class="absolute top-4 left-4 size-6 border-t-2 border-l-2 {{ $hoek }}" aria-hidden="true"></span>
    <span class="absolute top-4 right-4 size-6 border-t-2 border-r-2 {{ $hoek }}" aria-hidden="true"></span>
    <span class="absolute bottom-4 left-4 size-6 border-b-2 border-l-2 {{ $hoek }}" aria-hidden="true"></span>
    <span class="absolute right-4 bottom-4 size-6 border-r-2 border-b-2 {{ $hoek }}" aria-hidden="true"></span>
</div>
