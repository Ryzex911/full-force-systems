{{-- Ons verhaal en onze missie ($history en $mission uit AboutController, tekst van de opdrachtgever) --}}
<section class="py-16 lg:py-24">
    <div class="wrap grid gap-10 lg:grid-cols-[1fr_440px] lg:gap-16">
        <div class="flex flex-col gap-6">
            <x-section-heading label="Ons verhaal" title="Ontstaan vanuit de praktijk van Full Force Security" />

            <div class="flex max-w-[640px] flex-col gap-4">
                @foreach ($history as $alinea)
                    <p class="text-body text-ink-2">{{ $alinea }}</p>
                @endforeach
            </div>

            <div class="flex flex-col gap-3 pt-2">
                <p class="text-label text-ink-3">Werkgebied</p>
                <ul class="flex flex-wrap gap-3">
                    @foreach (config('site.regions') as $regio)
                        <li class="text-body-sm flex items-center gap-2 rounded-lg border border-line px-3.5 py-2 text-ink">
                            <x-icon name="pin" class="size-4 text-brand-ink" />
                            {{ $regio }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="flex flex-col gap-5 self-start rounded-2xl border-2 border-brand bg-surface p-7 sm:p-10">
            <span class="icon-tile">
                <x-icon name="shield" class="size-6" />
            </span>
            <p class="text-label text-brand-ink">Onze missie</p>
            @foreach ($mission as $alinea)
                <p class="{{ $loop->first ? 'text-body-lg text-ink' : 'text-body text-ink-2' }}">{{ $alinea }}</p>
            @endforeach
        </div>
    </div>
</section>
