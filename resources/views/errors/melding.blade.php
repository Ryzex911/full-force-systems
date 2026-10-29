{{--
    Gedeelde opmaak voor de foutpagina's (404, 419, 429).
    Gebruik in errors/404.blade.php: @include('errors.melding', ['code' => 404, 'kop' => '...', 'tekst' => '...'])
--}}
<section class="py-20 lg:py-32">
    <div class="wrap flex flex-col items-start gap-6">
        <p class="text-label text-brand-ink">Foutcode {{ $code }}</p>
        <h1 class="text-h1 max-w-[720px] text-ink">{{ $kop }}</h1>
        <p class="text-body-lg max-w-[620px] text-ink-2">{{ $tekst }}</p>

        <div class="flex flex-wrap gap-3">
            @isset($terug)
                <x-button :href="$terug">Terug naar de vorige pagina</x-button>
            @endisset
            <x-button :variant="isset($terug) ? 'secondary' : 'primary'" :href="route('home')">Naar de homepage</x-button>
            <x-button variant="secondary" :href="route('contact')">Contact</x-button>
        </div>

        <p class="text-body-sm text-ink-3">
            Liever direct contact? Bel <a href="{{ config('site.phone_href') }}" class="text-ink-2 underline hover:text-ink">{{ config('site.phone') }}</a>
            of mail naar <a href="mailto:{{ config('site.email') }}" class="text-ink-2 underline hover:text-ink">{{ config('site.email') }}</a>.
        </p>
    </div>
</section>
