{{--
    Alle diensten onder elkaar ($services uit ServiceController).
    Elke dienst heeft een eigen id (de slug), zodat je er direct naartoe kunt linken: /diensten#camerabewaking
--}}
@use('App\Support\Nav')

<section class="py-12 lg:py-24" aria-label="Onze diensten">
    <div class="wrap flex flex-col gap-6">
        @foreach ($services as $dienst)
            <article id="{{ $dienst['slug'] }}" class="card flex scroll-mt-36 flex-col overflow-hidden lg:flex-row">
                {{-- Foto of, als er geen foto is, het icoon van de dienst --}}
                <div class="relative flex h-44 shrink-0 items-center justify-center bg-surface-2 text-ink-3 lg:h-auto lg:w-[280px]">
                    @if ($dienst['image'])
                        <img src="{{ asset($dienst['image']) }}" alt="" class="absolute inset-0 size-full object-cover" loading="lazy">
                    @else
                        <x-icon :name="$dienst['icon']" class="size-[72px]" />
                    @endif
                </div>

                <div class="flex grow flex-col gap-3.5 p-6 sm:p-8">
                    <h2 class="text-h3 text-ink">{{ $dienst['title'] }}</h2>
                    <p class="text-body text-ink-2">{{ $dienst['text'] }}</p>
                    <x-check-list :items="$dienst['points']" />
                </div>

                {{-- Voor wie, prijs en de knop --}}
                <div class="flex shrink-0 flex-col gap-4 border-t border-line p-6 sm:p-8 lg:w-[300px] lg:border-t-0 lg:border-l">
                    <dl class="flex flex-col gap-4">
                        <div class="flex flex-col gap-1">
                            <dt class="text-label text-ink-3">Voor</dt>
                            <dd class="text-body-sm text-ink">Particulier en zakelijk</dd>
                        </div>
                        <div class="flex flex-col gap-1">
                            <dt class="text-label text-ink-3">Prijs</dt>
                            <dd class="text-body-sm text-ink">
                                Particulier: vaste prijs<br>
                                Zakelijk: vanaf-prijs
                            </dd>
                        </div>
                    </dl>

                    {{-- Naar het offerteformulier met deze dienst al ingevuld --}}
                    <x-button :href="Nav::quote(['dienst' => $dienst['slug']])" class="mt-auto w-full" aria-label="Offerte aanvragen: {{ strtolower($dienst['title']) }}">Offerte aanvragen</x-button>
                </div>
            </article>
        @endforeach
    </div>
</section>
