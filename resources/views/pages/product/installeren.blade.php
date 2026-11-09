{{-- Balk "Liever laten installeren?" met een offerteknop voor dit product --}}
@use('App\Support\Nav')

<section class="pb-16 lg:pb-24">
    <div class="wrap">
        <div class="card flex flex-col gap-6 p-6 sm:p-8 md:flex-row md:items-center md:justify-between">
            <div class="flex items-start gap-5">
                <span class="icon-tile shrink-0"><x-icon name="wrench" class="size-6" /></span>
                <div class="flex flex-col gap-1.5">
                    <h2 class="text-h3 text-ink">Liever laten installeren?</h2>
                    <p class="text-body text-ink-2">Wij monteren dit product, stellen het af en leggen uit hoe alles werkt.</p>
                </div>
            </div>
            <x-button variant="secondary" :href="Nav::quote(['product' => $product['title']])" class="shrink-0">Offerte aanvragen</x-button>
        </div>
    </div>
</section>
