{{--
    Keuze particulier / zakelijk.
    De browser onthoudt de keuze en zet data-klant op <html> (zie resources/js/app.js).
    Met de variant zakelijk: (bijv. zakelijk:hidden) toont een pagina andere inhoud; zie de knoppen in pages/home/hero.blade.php.
--}}
<div class="inline-flex items-center rounded-full bg-surface-2 p-[3px]" role="group" aria-label="Ik ben">
    <button type="button" data-klanttype="particulier" aria-pressed="true" class="text-caption rounded-full px-3.5 py-[5px] text-ink-2 aria-pressed:bg-brand aria-pressed:text-white">
        Particulier
    </button>
    <button type="button" data-klanttype="zakelijk" aria-pressed="false" class="text-caption rounded-full px-3.5 py-[5px] text-ink-2 aria-pressed:bg-brand aria-pressed:text-white">
        Zakelijk
    </button>
</div>
