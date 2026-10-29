{{--
    Tijdelijk logo (rood blokje met "FF"). Vervangen zodra de opdrachtgever het officiële logo aanlevert.
--}}
<a href="{{ route('home') }}" {{ $attributes->merge(['class' => 'inline-flex items-center gap-3']) }} aria-label="{{ config('site.name') }}, naar de homepage">
    <span class="flex size-10 items-center justify-center rounded-lg bg-brand text-[16px] font-black text-white">FF</span>
    <span class="flex flex-col gap-0.5">
        <span class="text-[15px] leading-[18px] font-extrabold tracking-[0.06em] text-ink">FULL FORCE</span>
        <span class="text-[11px] leading-[13px] font-semibold tracking-[0.3em] text-brand-ink">SYSTEMS</span>
    </span>
</a>
