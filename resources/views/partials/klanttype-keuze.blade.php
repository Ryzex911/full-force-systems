{{--
    Keuze particulier / zakelijk.
    Voor nu onthoudt de browser alleen de keuze (zie resources/js/app.js).
    Later kan de pagina hiermee andere inhoud tonen.
--}}
<div class="inline-flex items-center rounded-full bg-surface-2 p-[3px]" role="group" aria-label="Ik ben">
    <button type="button" data-klanttype="particulier" aria-pressed="true" class="text-caption rounded-full px-3.5 py-[5px] text-ink-2 aria-pressed:bg-brand aria-pressed:text-white">
        Particulier
    </button>
    <button type="button" data-klanttype="zakelijk" aria-pressed="false" class="text-caption rounded-full px-3.5 py-[5px] text-ink-2 aria-pressed:bg-brand aria-pressed:text-white">
        Zakelijk
    </button>
</div>
