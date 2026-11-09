{{--
    Aantal kiezen met − en + (productpagina en winkelwagen).
    Gebruik: <x-quantity name="aantal" :value="1" label="Aantal" />
    De knoppen werken met JavaScript (resources/js/app.js, data-aantal). Zonder JavaScript typt de bezoeker het aantal in.
    min: het laagste aantal (in de winkelwagen 0 = weghalen).
--}}
@use('App\Support\Cart')
@props(['name' => 'aantal', 'value' => 1, 'min' => 1, 'max' => Cart::MAX_QUANTITY, 'label' => 'Aantal', 'id' => null])

@php
    $id ??= 'aantal-'.uniqid();
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex h-12 items-center rounded-lg border border-line bg-surface']) }} data-aantal>
    <label for="{{ $id }}" class="sr-only">{{ $label }}</label>
    <button type="button" class="flex h-full w-11 items-center justify-center rounded-l-lg text-ink-2 hover:bg-surface-2 hover:text-ink" data-aantal-min aria-label="Eén minder">
        <x-icon name="minus" class="size-4" />
    </button>
    <input
        id="{{ $id }}" name="{{ $name }}" type="number" inputmode="numeric"
        value="{{ $value }}" min="{{ $min }}" max="{{ $max }}" step="1"
        class="text-body h-full w-12 [appearance:textfield] bg-transparent text-center font-semibold text-ink focus:outline-none [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
    >
    <button type="button" class="flex h-full w-11 items-center justify-center rounded-r-lg text-ink-2 hover:bg-surface-2 hover:text-ink" data-aantal-plus aria-label="Eén meer">
        <x-icon name="plus" class="size-4" />
    </button>
</div>
