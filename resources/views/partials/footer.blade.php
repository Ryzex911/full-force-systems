{{--
    Footer met bedrijfsgegevens. Alles komt uit config/site.php.
--}}
<footer class="bg-alt">
    <div class="wrap grid gap-12 py-16 sm:grid-cols-2 lg:grid-cols-[320px_1fr_1fr_240px] lg:gap-16 lg:py-[72px]">
        <div class="flex flex-col items-start gap-5">
            <x-logo />

            <p class="text-body-sm text-ink-2">
                Camera-, alarm- en toegangscontrolesystemen voor woningen en bedrijven. Onderdeel van Full Force Security.
            </p>

            <ul class="flex flex-wrap gap-2" aria-label="Betaalmethodes">
                @foreach (config('site.payment_methods') as $methode)
                    <li class="text-caption rounded-md border border-line px-2.5 py-1.5 text-ink-2">{{ $methode }}</li>
                @endforeach
            </ul>
        </div>

        <nav class="flex flex-col gap-3.5" aria-label="Footernavigatie">
            <h2 class="text-label text-ink">Navigatie</h2>
            <ul class="text-body-sm flex flex-col gap-3.5 text-ink-2">
                @foreach (config('site.nav') as $item)
                    <li>
                        <a href="{{ $item['route'] ? route($item['route']) : '#' }}" class="hover:text-ink">{{ $item['label'] }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="flex flex-col gap-3.5">
            <h2 class="text-label text-ink">Diensten</h2>
            <ul class="text-body-sm flex flex-col gap-3.5 text-ink-2">
                @foreach (config('site.services') as $dienst)
                    <li>
                        <a href="#" class="hover:text-ink">{{ $dienst['title'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex flex-col gap-3.5">
            <h2 class="text-label text-ink">Contact</h2>
            <address class="text-body-sm flex flex-col gap-3.5 text-ink-2 not-italic">
                <span>
                    {{ config('site.address.street') }}<br>
                    {{ config('site.address.postcode') }} {{ config('site.address.city') }}
                </span>
                <a href="{{ config('site.phone_href') }}" class="hover:text-ink">{{ config('site.phone') }}</a>
                <a href="mailto:{{ config('site.email') }}" class="hover:text-ink">{{ config('site.email') }}</a>
                <span>{{ config('site.hours') }}</span>
            </address>
        </div>
    </div>

    <div class="border-t border-line">
        <div class="wrap text-body-sm flex flex-col gap-3 py-5 text-ink-3 lg:flex-row lg:items-center lg:justify-between">
            <p>© {{ date('Y') }} {{ config('site.name') }} — handelsnaam van {{ config('site.legal_name') }}</p>

            <ul class="flex flex-wrap gap-x-5 gap-y-2">
                <li><a href="#" class="hover:text-ink">Privacyverklaring</a></li>
                <li><a href="#" class="hover:text-ink">Algemene voorwaarden</a></li>
                <li><a href="#" class="hover:text-ink">Cookiebeleid</a></li>
                <li><a href="#" class="hover:text-ink">Retourneren</a></li>
            </ul>
        </div>
    </div>
</footer>
