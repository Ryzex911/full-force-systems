{{-- Filterknoppen per dienst. Gewone links (/projecten?dienst=...), dus ze werken ook zonder JavaScript. --}}
<nav aria-label="Filter op dienst">
    <ul class="flex flex-wrap gap-2.5">
        @foreach (['' => 'Alle'] + $filters->all() as $slug => $label)
            @php $actief = ($dienst ?? '') === $slug; @endphp
            <li>
                <a
                    href="{{ $slug ? route('projecten', ['dienst' => $slug]) : route('projecten') }}"
                    class="text-caption inline-flex rounded-full border px-4 py-2 transition-colors {{ $actief ? 'border-brand bg-brand text-white' : 'border-line text-ink-2 hover:border-ink-3 hover:text-ink' }}"
                    @if ($actief) aria-current="true" @endif
                >{{ $label }}</a>
            </li>
        @endforeach
    </ul>
</nav>
