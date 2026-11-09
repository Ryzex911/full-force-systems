{{--
    Korte melding na een actie, bijvoorbeeld "4K IP-camera buiten staat in uw winkelwagen."
    Een controller geeft hem mee met: ->with('melding', ['tekst' => '...', 'link' => url, 'linkTekst' => '...'])
    (link en linkTekst zijn optioneel). We gebruiken 'melding' en niet 'status', omdat Breeze 'status' zelf al gebruikt.
--}}
@if ($melding = session('melding'))
    <div class="border-b border-line bg-ok-soft" role="status">
        <div class="wrap text-body-sm flex flex-wrap items-center justify-between gap-x-6 gap-y-2 py-3 text-ink">
            <p class="flex items-center gap-2.5">
                <x-icon name="check-circle" class="size-5 text-ok" />
                {{ $melding['tekst'] }}
            </p>
            @if (! empty($melding['link']))
                <x-button variant="link" :href="$melding['link']">{{ $melding['linkTekst'] ?? 'Bekijken' }}</x-button>
            @endif
        </div>
    </div>
@endif
