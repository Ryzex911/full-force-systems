{{-- Balk met de vier sterke punten ($usps uit HomeController) --}}
<section class="bg-alt" aria-label="Waarom Full Force Systems">
    <ul class="wrap grid gap-x-8 gap-y-5 py-7 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($usps as $usp)
            <li class="text-body-sm flex items-center gap-3 text-ink">
                <x-icon :name="$usp['icon']" class="size-[22px] text-brand-ink" />
                {{ $usp['text'] }}
            </li>
        @endforeach
    </ul>
</section>
