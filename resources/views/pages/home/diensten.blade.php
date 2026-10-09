{{--
    Diensten: de eerste twee (camera en alarm) groot uitgelicht, de andere drie als kaart.
    De diensten staan in config/site.php ('services').
--}}
@php
    $uitgelicht = array_slice(config('site.services'), 0, 2);
    $overig = array_slice(config('site.services'), 2);
@endphp

<section id="diensten" class="scroll-mt-32 py-16 lg:py-24">
    <div class="wrap flex flex-col gap-12">
        <x-section-heading
            label="Diensten"
            title="Eén aanspreekpunt voor uw beveiligingstechniek"
            text="Van advies en installatie tot onderhoud. Camera- en alarmsystemen staan bij ons centraal."
        />

        <div class="grid gap-6 lg:grid-cols-2">
            @foreach ($uitgelicht as $dienst)
                <article class="card flex overflow-hidden">
                    <div class="flex grow flex-col items-start gap-4 p-8">
                        <span class="icon-tile">
                            <x-icon :name="$dienst['icon']" class="size-6" />
                        </span>

                        <h3 class="text-h3 text-ink">{{ $dienst['title'] }}</h3>
                        <p class="text-body-sm text-ink-2">{{ $dienst['text'] }}</p>

                        <ul class="flex flex-col gap-2.5">
                            @foreach ($dienst['points'] as $punt)
                                <li class="text-body-sm flex items-start gap-2.5 text-ink-2">
                                    <x-icon name="check" class="size-5 text-brand-ink" />
                                    {{ $punt }}
                                </li>
                            @endforeach
                        </ul>

                        <x-button variant="link" href="#" class="mt-auto">Meer over {{ strtolower($dienst['title']) }}</x-button>
                    </div>

                    {{-- Foto of, als er geen foto is, het icoon van de dienst --}}
                    <div class="hidden w-[200px] shrink-0 items-center justify-center bg-surface-2 text-ink-3 sm:flex">
                        @if ($dienst['image'])
                            <img src="{{ $dienst['image'] }}" alt="" class="size-full object-cover" loading="lazy">
                        @else
                            <x-icon :name="$dienst['icon']" class="size-[72px]" />
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @foreach ($overig as $dienst)
                <x-service-card :icon="$dienst['icon']" :title="$dienst['title']" :text="$dienst['text']" />
            @endforeach
        </div>
    </div>
</section>
