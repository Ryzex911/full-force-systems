{{--
    Veelgestelde vragen ($service['faq']). <details> klapt open zonder JavaScript; het plus-icoon draait naar een kruisje.
    De antwoorden volgen nog van de opdrachtgever. Tot die tijd verwijzen we naar telefoon en het offerteformulier.
--}}
@use('App\Support\Nav')

<section class="py-16 lg:py-24">
    <div class="wrap flex flex-col gap-10">
        <x-section-heading label="Veelgestelde vragen" title="Goed om te weten" />

        <div class="flex flex-col border-t border-line">
            @foreach ($service['faq'] as $vraag)
                <details class="group border-b border-line">
                    <summary class="text-body flex cursor-pointer list-none items-center justify-between gap-6 py-5 font-semibold text-ink hover:text-brand-ink [&::-webkit-details-marker]:hidden">
                        {{ $vraag }}
                        <x-icon name="plus" class="size-5 text-ink-3 transition-transform group-open:rotate-45" />
                    </summary>
                    <p class="text-body max-w-[760px] pb-6 text-ink-2">
                        Het antwoord op deze vraag volgt binnenkort. Wilt u het nu al weten? Bel ons op
                        <a href="{{ config('site.phone_href') }}" class="text-ink underline hover:text-brand-ink">{{ config('site.phone') }}</a>
                        of stel uw vraag via het <a href="{{ Nav::quote(['dienst' => $service['slug']]) }}" class="text-ink underline hover:text-brand-ink">contactformulier</a>.
                    </p>
                </details>
            @endforeach
        </div>

        {{-- TODO: weghalen zodra de antwoorden er zijn --}}
        <p class="text-body-sm text-ink-3">Antwoorden volgen van de opdrachtgever.</p>
    </div>
</section>
