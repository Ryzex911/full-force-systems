{{--
    Pagina van één project, bijvoorbeeld /projecten/tax-administraties.
    Er is geen Figma-ontwerp; gebouwd in de stijl van de dienstpagina (x-page-header met foto rechts).
    Gegevens uit ProjectController@show: $project, $services (de diensten van dit project) en $others (andere projecten).
    Alleen "Tax administraties" is een echt project; we tonen geen details die we niet van de opdrachtgever hebben.
--}}
@use('App\Support\Nav')

@extends('layouts.app')

@section('title', $project['title'].' – project')
@section('description', $project['text'] ?? 'Project van Full Force Systems: '.strtolower($project['tag']).'.')

@section('content')
    <x-page-header
        :text="$project['text'] ?? 'Dit is een voorbeeldproject. De echte gegevens en foto\'s volgen van de opdrachtgever.'"
        :crumbs="[['label' => 'Projecten', 'url' => route('projecten')], ['label' => $project['title']]]"
    >
        {{ $project['title'] }}

        <x-slot:actions>
            <dl class="grid w-full grid-cols-2 gap-5 sm:grid-cols-3">
                @foreach (['Plaats' => $project['location'], 'Dienst' => $project['tag'], 'Type' => $project['type']] as $kop => $waarde)
                    <div class="flex flex-col gap-1">
                        <dt class="text-label text-ink-3">{{ $kop }}</dt>
                        <dd class="text-body-sm text-ink">{{ $waarde }}</dd>
                    </div>
                @endforeach
            </dl>
            <x-button :href="Nav::quote(array_filter(['dienst' => $project['services'][0] ?? null, 'klant' => strtolower($project['type'])]))">Zelf ook zo'n project?</x-button>
        </x-slot:actions>

        <x-slot:media>
            <div class="aspect-[4/3] overflow-hidden rounded-2xl border border-line bg-surface-2">
                <img src="{{ $project['image'] }}" alt="{{ $project['alt'] }}" class="size-full object-cover">
            </div>
        </x-slot:media>
    </x-page-header>

    {{-- Welke diensten bij dit project horen, met een link naar de dienstpagina --}}
    <section class="py-16 lg:py-24">
        <div class="wrap flex flex-col gap-10">
            <x-section-heading label="Wat wij deden" title="Geleverde diensten" />

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $dienst)
                    <x-service-card :icon="$dienst['icon']" :title="$dienst['title']" :text="$dienst['text']" :href="route('diensten.show', $dienst['slug'])" />
                @endforeach
            </div>

            {{-- TODO: weghalen zodra de opdrachtgever eigen projectfoto's en meer details heeft aangeleverd --}}
            <p class="text-body-sm text-ink-3">De foto is tijdelijk. Meer details en eigen foto's van dit project volgen van de opdrachtgever.</p>
        </div>
    </section>

    @include('partials.werkwijze')

    {{-- Andere projecten --}}
    @if ($others->isNotEmpty())
        <section class="py-16 lg:py-24">
            <div class="wrap flex flex-col gap-10">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <x-section-heading label="Meer projecten" title="Ander werk van ons" />
                    <x-button variant="link" :href="route('projecten')">Alle projecten</x-button>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($others as $ander)
                        <x-project-card
                            :tag="$ander['tag']"
                            :title="$ander['title']"
                            :location="$ander['location']"
                            :image="$ander['image']"
                            :alt="$ander['alt']"
                            :href="route('projecten.show', $ander['slug'])"
                        />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('partials.cta', ['ctaOfferte' => array_filter(['dienst' => $project['services'][0] ?? null])])
@endsection
