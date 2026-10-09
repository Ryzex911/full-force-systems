{{--
    Blok "Op zoek naar een beveiligingsoplossing?" Kan op elke pagina onderaan worden gezet met @include('partials.cta').
--}}
<section id="offerte" class="scroll-mt-32 pb-16 lg:pb-24">
    <div class="wrap">
        <div class="card flex flex-col overflow-hidden rounded-2xl lg:flex-row">
            <div class="flex min-w-0 grow flex-col items-start gap-5 p-6 sm:p-8 lg:p-14">
                <p class="text-label text-brand-ink">Maatwerk</p>
                <h2 class="text-h2 w-full max-w-[560px] text-ink">Op zoek naar een beveiligings&shy;oplossing?</h2>
                <p class="text-body max-w-[560px] text-ink-2">
                    Wij denken met u mee. Vraag vrijblijvend een offerte aan en ontvang een voorstel dat past bij uw woning of bedrijfspand.
                </p>

                <div class="flex flex-wrap gap-3">
                    <x-button href="#">Offerte aanvragen</x-button>
                    <x-button variant="secondary" :href="config('site.phone_href')">Bel {{ config('site.phone') }}</x-button>
                </div>
            </div>

            <div class="h-56 shrink-0 bg-surface-2 lg:h-auto lg:w-[420px]">
                <img
                    src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=900&q=70"
                    alt=""
                    class="size-full object-cover"
                    loading="lazy"
                >
            </div>
        </div>
    </div>
</section>
