{{--
    Formulierveld in de huisstijl: label, invoer en foutmelding.
    Gebruik: <x-field name="email" label="E-mailadres" type="email" required autocomplete="email" />
    Types: text, email, tel, number, search, textarea en select (geef dan :options="['waarde' => 'Tekst']" mee).
    Na een fout blijft de ingevulde waarde staan (old) en verschijnt de melding onder het veld.
    Extra attributen (autocomplete, placeholder, rows, min ...) gaan naar het invoerveld.

    Extra instellingen (zie de filters in de webshop):
      size="sm"               kleiner veld op de achtergrond van de pagina (filters); standaard voor formulieren in een kaart
      icon="search"           icoon links in het veld
      :hide-label="true"      label alleen voor schermlezers (sr-only), bijvoorbeeld bij een zoekveld met icoon
      :mark-optional="false"  geen "(optioneel)" achter het label
      :placeholder="false"    bij een select: geen lege eerste keuze
--}}
@props([
    'name', 'label', 'type' => 'text', 'value' => null, 'required' => false, 'hint' => null, 'options' => [], 'placeholder' => null,
    'size' => 'md', 'icon' => null, 'hideLabel' => false, 'markOptional' => true,
])

@php
    $id = 'veld-'.$name;
    $fout = $errors->first($name);
    $waarde = old($name, $value);
    $beschrijving = trim(($hint ? $id.'-hint ' : '').($fout ? $id.'-fout' : ''));

    $maat = $size === 'sm'
        ? 'bg-surface py-2.5 text-body-sm '.($icon ? 'pl-10 pr-3.5' : 'px-3.5')
        : 'bg-page py-3 text-body '.($icon ? 'pl-11 pr-4' : 'px-4');

    $invoer = 'w-full rounded-lg border text-ink placeholder:text-ink-3 transition-colors focus:border-brand-ink focus:outline-none '.$maat.' '
        .($fout ? 'border-brand-ink' : 'border-line hover:border-ink-3');
@endphp

<div class="flex flex-col gap-2">
    <label for="{{ $id }}" class="{{ $hideLabel ? 'sr-only' : ($size === 'sm' ? 'text-body-sm text-ink-2' : 'text-body-sm font-semibold text-ink') }}">
        {{ $label }}
        @if (! $required && $markOptional)
            <span class="font-normal text-ink-3">(optioneel)</span>
        @endif
    </label>

    <div class="relative">
        @if ($icon)
            <x-icon :name="$icon" class="pointer-events-none absolute top-1/2 {{ $size === 'sm' ? 'left-3.5 size-[18px]' : 'left-4 size-5' }} -translate-y-1/2 text-ink-3" />
        @endif

        @if ($type === 'textarea')
            <textarea
                id="{{ $id }}" name="{{ $name }}"
                @if ($required) required @endif
                @if ($placeholder) placeholder="{{ $placeholder }}" @endif
                @if ($fout) aria-invalid="true" @endif
                @if ($beschrijving) aria-describedby="{{ $beschrijving }}" @endif
                {{ $attributes->merge(['class' => $invoer.' min-h-36', 'rows' => 5]) }}
            >{{ $waarde }}</textarea>
        @elseif ($type === 'select')
            <select
                id="{{ $id }}" name="{{ $name }}"
                @if ($required) required @endif
                @if ($fout) aria-invalid="true" @endif
                @if ($beschrijving) aria-describedby="{{ $beschrijving }}" @endif
                {{ $attributes->merge(['class' => $invoer]) }}
            >
                @if ($placeholder !== false)
                    <option value="">{{ $placeholder ?? 'Maak een keuze' }}</option>
                @endif
                @foreach ($options as $optieWaarde => $optieTekst)
                    <option value="{{ $optieWaarde }}" @selected((string) $waarde === (string) $optieWaarde)>{{ $optieTekst }}</option>
                @endforeach
            </select>
        @else
            <input
                id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" value="{{ $waarde }}"
                @if ($required) required @endif
                @if ($placeholder) placeholder="{{ $placeholder }}" @endif
                @if ($fout) aria-invalid="true" @endif
                @if ($beschrijving) aria-describedby="{{ $beschrijving }}" @endif
                {{ $attributes->merge(['class' => $invoer]) }}
            >
        @endif
    </div>

    @if ($hint)
        <p id="{{ $id }}-hint" class="text-body-sm text-ink-3">{{ $hint }}</p>
    @endif

    @if ($fout)
        <p id="{{ $id }}-fout" class="text-body-sm flex items-start gap-1.5 text-brand-ink">
            <x-icon name="alert" class="mt-0.5 size-4" />
            {{ $fout }}
        </p>
    @endif
</div>
