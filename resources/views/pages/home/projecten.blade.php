{{-- Recente projecten ($projects uit HomeController) --}}
<section id="projecten" class="scroll-mt-32 bg-alt py-16 lg:py-24">
    <div class="wrap flex flex-col gap-12">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <x-section-heading label="Projecten" title="Recent opgeleverd" />
            <x-button variant="link" href="#">Alle projecten</x-button>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @foreach ($projects as $project)
                <x-project-card
                    :tag="$project['tag']"
                    :title="$project['title']"
                    :location="$project['location']"
                    :image="$project['image']"
                    :alt="$project['alt']"
                />
            @endforeach
        </div>
    </div>
</section>
