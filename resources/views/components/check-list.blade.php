{{--
    Opsomming met rode vinkjes.
    Gebruik: <x-check-list :items="['Advies op locatie', 'Montage en afstelling']" />
    De tekstkleur geef je mee met class (standaard text-ink-2).
--}}
@props(['items' => []])

<ul {{ $attributes->merge(['class' => 'flex flex-col gap-2.5 text-ink-2']) }}>
    @foreach ($items as $item)
        <li class="text-body-sm flex items-start gap-2.5">
            <x-icon name="check" class="size-5 text-brand-ink" />
            {{ $item }}
        </li>
    @endforeach
</ul>
