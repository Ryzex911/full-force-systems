{{--
    Contactgegevens en werkwijze naast het formulier. Alles komt uit config/site.php.
--}}
<aside class="flex flex-col gap-6" aria-label="Contactgegevens">
    <div class="card flex flex-col gap-5 p-7">
        <h2 class="text-h3 text-ink">Direct contact</h2>

        <ul class="flex flex-col gap-4">
            <li>
                <a href="{{ config('site.phone_href') }}" class="group flex items-center gap-4">
                    <span class="icon-tile size-11"><x-icon name="phone" class="size-[22px]" /></span>
                    <span class="flex flex-col">
                        <span class="text-body-sm text-ink-3">Bel ons</span>
                        <span class="text-h4 text-ink group-hover:text-brand-ink">{{ config('site.phone') }}</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="mailto:{{ config('site.email') }}" class="group flex items-center gap-4">
                    <span class="icon-tile size-11"><x-icon name="mail" class="size-[22px]" /></span>
                    <span class="flex min-w-0 flex-col">
                        <span class="text-body-sm text-ink-3">Mail ons</span>
                        <span class="text-h4 break-all text-ink group-hover:text-brand-ink">{{ config('site.email') }}</span>
                    </span>
                </a>
            </li>
            <li class="flex items-center gap-4">
                <span class="icon-tile size-11"><x-icon name="clock" class="size-[22px]" /></span>
                <span class="flex flex-col">
                    <span class="text-body-sm text-ink-3">Bereikbaar</span>
                    <span class="text-body text-ink">{{ config('site.hours') }}</span>
                </span>
            </li>
            <li class="flex items-center gap-4">
                <span class="icon-tile size-11"><x-icon name="pin" class="size-[22px]" /></span>
                <address class="flex flex-col not-italic">
                    <span class="text-body-sm text-ink-3">Adres</span>
                    <span class="text-body text-ink">
                        {{ config('site.address.street') }}, {{ config('site.address.postcode') }} {{ config('site.address.city') }}
                    </span>
                </address>
            </li>
        </ul>

        <div class="flex flex-col gap-2 border-t border-line pt-5">
            <p class="text-label text-ink-3">Werkgebied</p>
            <ul class="flex flex-wrap gap-2">
                @foreach (config('site.regions') as $regio)
                    <li class="text-caption rounded-md border border-line px-2.5 py-1.5 text-ink-2">{{ $regio }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card flex flex-col gap-5 p-7">
        <h2 class="text-h3 text-ink">Zo gaat het verder</h2>
        <ol class="flex flex-col gap-4">
            @foreach (config('site.steps') as $nummer => $stap)
                <li class="flex gap-4">
                    <span class="text-h4 w-7 shrink-0 text-brand-ink" aria-hidden="true">0{{ $nummer + 1 }}</span>
                    <span class="flex flex-col gap-0.5">
                        <span class="text-body font-semibold text-ink">{{ $stap['title'] }}</span>
                        <span class="text-body-sm text-ink-2">{{ $stap['text'] }}</span>
                    </span>
                </li>
            @endforeach
        </ol>
    </div>
</aside>
