{{--
    Het uitgelichte project groot, daaronder de andere projecten en een kaart "Uw project hier?".
    "Bekijk project" verschijnt vanzelf zodra er een projectpagina is (route 'projecten.show').
--}}
@use('App\Support\Nav')

@if (! $featured && $projects->isEmpty())
    <div class="card flex flex-col items-center gap-4 px-6 py-14 text-center">
        <span class="icon-tile size-14"><x-icon name="building" class="size-7" /></span>
        <h2 class="text-h3 text-ink">Nog geen projecten voor deze dienst</h2>
        <p class="text-body max-w-[460px] text-ink-2">
            Wij tonen alleen projecten waarvoor de klant toestemming gaf. Benieuwd wat wij voor u kunnen doen? Vraag vrijblijvend een voorstel aan.
        </p>
        <div class="flex flex-wrap justify-center gap-3">
            <x-button :href="Nav::quote($dienst ? ['dienst' => $dienst] : [])">Offerte aanvragen</x-button>
            <x-button variant="secondary" :href="route('projecten')">Alle projecten</x-button>
        </div>
    </div>
@else
    @if ($featured)
        <article class="card flex flex-col overflow-hidden lg:flex-row">
            <div class="h-64 shrink-0 bg-surface-2 sm:h-80 lg:h-auto lg:w-[56%]">
                <img src="{{ $featured['image'] }}" alt="{{ $featured['alt'] }}" class="size-full object-cover">
            </div>

            <div class="flex flex-col items-start gap-5 p-6 sm:p-8 lg:p-10">
                <span class="text-label rounded-full bg-brand-soft px-3 py-1.5 text-brand-ink">Uitgelicht</span>
                <h2 class="text-h2 text-ink">{{ $featured['title'] }}</h2>
                @if ($featured['text'])
                    <p class="text-body text-ink-2">{{ $featured['text'] }}</p>
                @endif

                <dl class="grid w-full grid-cols-2 gap-5 sm:grid-cols-3">
                    @foreach (['Plaats' => $featured['location'], 'Dienst' => $featured['tag'], 'Type' => $featured['type']] as $kop => $waarde)
                        <div class="flex flex-col gap-1">
                            <dt class="text-label text-ink-3">{{ $kop }}</dt>
                            <dd class="text-body-sm text-ink">{{ $waarde }}</dd>
                        </div>
                    @endforeach
                </dl>

                @if ($link = Nav::page('projecten.show', ['slug' => $featured['slug']]))
                    <x-button variant="link" :href="$link">Bekijk project</x-button>
                @endif
            </div>
        </article>
    @endif

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($projects as $project)
            <x-project-card
                :tag="$project['tag']"
                :title="$project['title']"
                :location="$project['location']"
                :image="$project['image']"
                :alt="$project['alt']"
            />
        @endforeach

        {{-- Kaart "Uw project hier?" --}}
        <article class="card flex flex-col items-start justify-center gap-4 p-7">
            <span class="icon-tile"><x-icon name="plus" class="size-6" /></span>
            <h3 class="text-h3 text-ink">Uw project hier?</h3>
            <p class="text-body-sm text-ink-2">Vertel ons wat u wilt beveiligen. Wij maken een voorstel.</p>
            <x-button variant="link" :href="Nav::quote($dienst ? ['dienst' => $dienst] : [])">Offerte aanvragen</x-button>
        </article>
    </div>
@endif

{{-- TODO: weghalen zodra de echte projecten en foto's er zijn --}}
<p class="text-body-sm text-ink-3">Twee projecten zijn voorbeelden — echte projecten en foto's volgen van de opdrachtgever.</p>
