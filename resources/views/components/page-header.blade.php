{{--
    Kop bovenaan een vervolgpagina: kruimelpad, titel en korte tekst.
    De titel zet je tussen de tags. Daardoor kun je &shy; gebruiken op de plek waar een lang woord mag afbreken.
    "Home" staat altijd vooraan; geef de rest mee met crumbs. De laatste kruimel is de huidige pagina (geen url).
    Gebruik: <x-page-header text="..." :crumbs="[['label' => 'Diensten']]">Onze diensten</x-page-header>
--}}
@props(['text' => null, 'crumbs' => []])

<section {{ $attributes->merge(['class' => 'bg-alt']) }}>
    <div class="wrap flex flex-col gap-4 py-12 lg:py-16">
        <nav aria-label="Kruimelpad">
            <ol class="text-body-sm flex flex-wrap items-center gap-2 text-ink-3">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-ink">Home</a>
                </li>
                @foreach ($crumbs as $crumb)
                    <li aria-hidden="true">/</li>
                    <li>
                        @if (! empty($crumb['url']))
                            <a href="{{ $crumb['url'] }}" class="hover:text-ink">{{ $crumb['label'] }}</a>
                        @else
                            <span class="text-ink-2" aria-current="page">{{ $crumb['label'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>

        <h1 class="text-h1 max-w-[860px] text-ink">{{ $slot }}</h1>

        @if ($text)
            <p class="text-body-lg max-w-[720px] text-ink-2">{{ $text }}</p>
        @endif
    </div>
</section>
