{{--
    Formulierveld in de huisstijl: label, invoer en foutmelding.
    Gebruik: <x-field name="email" label="E-mailadres" type="email" required autocomplete="email" />
    Types: text, email, tel, textarea en select (geef dan :options="['waarde' => 'Tekst']" mee).
    Na een fout blijft de ingevulde waarde staan (old) en verschijnt de melding onder het veld.
    Extra attributen (autocomplete, placeholder, rows ...) gaan naar het invoerveld.
--}}
@props(['name', 'label', 'type' => 'text', 'value' => null, 'required' => false, 'hint' => null, 'options' => [], 'placeholder' => null])

@php
    $id = 'veld-'.$name;
    $fout = $errors->first($name);
    $waarde = old($name, $value);
    $beschrijving = trim(($hint ? $id.'-hint ' : '').($fout ? $id.'-fout' : ''));

    $invoer = 'w-full rounded-lg border bg-page px-4 py-3 text-body text-ink placeholder:text-ink-3 transition-colors focus:border-brand-ink focus:outline-none '
        .($fout ? 'border-brand-ink' : 'border-line hover:border-ink-3');
@endphp

<div class="flex flex-col gap-2">
    <label for="{{ $id }}" class="text-body-sm font-semibold text-ink">
        {{ $label }}
        @unless ($required)
            <span class="font-normal text-ink-3">(optioneel)</span>
        @endunless
    </label>

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
            <option value="">{{ $placeholder ?? 'Maak een keuze' }}</option>
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
