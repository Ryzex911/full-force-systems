{{--
    Partners ($partners uit HomeController).
    Nu nog als tekst; vervangen door logo's zodra de opdrachtgever die aanlevert.
--}}
<section class="mb-12 bg-alt py-14" aria-label="Partners">
    <div class="wrap flex flex-col items-center gap-7">
        <p class="text-label text-ink-3">Wij werken samen met</p>

        <ul class="grid w-full grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
            @foreach ($partners as $partner)
                <li class="text-caption flex items-center justify-center rounded-[10px] border border-line px-3 py-5 text-center text-ink-2">
                    {{ $partner }}
                </li>
            @endforeach
        </ul>
    </div>
</section>
