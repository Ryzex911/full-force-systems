{{-- Waarom klanten voor ons kiezen ($strengths uit AboutController, uit het wensenformulier) --}}
<section class="bg-alt py-16 lg:py-24">
    <div class="wrap flex flex-col gap-12">
        <x-section-heading
            label="Waarom Full Force Systems"
            title="Waarom klanten voor ons kiezen"
            text="Geen ingewikkelde systemen, wel één vast aanspreekpunt dat weet wat er in de praktijk nodig is."
        />

        <ul class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($strengths as $punt)
                <li class="card flex flex-col gap-4 p-6">
                    <span class="icon-tile">
                        <x-icon :name="$punt['icon']" class="size-6" />
                    </span>
                    <p class="text-body font-semibold text-ink">{{ $punt['text'] }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</section>
