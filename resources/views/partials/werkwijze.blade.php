{{--
    Werkwijze in vier stappen. De stappen staan in config/site.php ('steps').
    Te gebruiken op elke pagina met @include('partials.werkwijze').
--}}
<section class="py-16 lg:py-24">
    <div class="wrap flex flex-col gap-12">
        <x-section-heading label="Werkwijze" title="In vier stappen geregeld" />

        <ol class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach (config('site.steps') as $nummer => $stap)
                <li class="flex flex-col gap-3 border-t border-line pt-6">
                    <span class="text-[26px] leading-8 font-extrabold text-brand-ink" aria-hidden="true">0{{ $nummer + 1 }}</span>
                    <h3 class="text-h4 text-ink">{{ $stap['title'] }}</h3>
                    <p class="text-body-sm text-ink-2">{{ $stap['text'] }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
