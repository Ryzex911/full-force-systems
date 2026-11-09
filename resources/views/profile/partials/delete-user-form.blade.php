{{--
    Account verwijderen (ProfileController@destroy). Foutmeldingen staan in de error bag 'userDeletion'.
    Het formulier zit in een uitklapblok (<details>), zodat niemand per ongeluk op "verwijderen" klikt.
    Bij een fout (verkeerd wachtwoord) staat het blok meteen open.
--}}
<section id="verwijderen" class="card scroll-mt-36 flex flex-col gap-4 p-6 sm:p-8">
    <header class="flex flex-col gap-1">
        <h2 class="text-h3 text-ink">Account verwijderen</h2>
        <p class="text-body-sm text-ink-2">Als u uw account verwijdert, worden al uw gegevens definitief gewist. Dit kan niet ongedaan worden gemaakt.</p>
    </header>

    <details class="group" @if ($errors->userDeletion->isNotEmpty()) open @endif>
        <summary class="text-body-sm inline-flex cursor-pointer list-none items-center gap-2 rounded-lg border border-brand-ink px-5 py-3 font-semibold text-brand-ink hover:bg-brand-soft group-open:hidden [&::-webkit-details-marker]:hidden">
            <x-icon name="trash" class="size-4" />
            Account verwijderen
        </summary>

        <form method="POST" action="{{ route('profile.destroy') }}" class="flex max-w-[560px] flex-col gap-5 rounded-lg border border-line bg-surface-2 p-5">
            @csrf
            @method('delete')

            <p class="text-body-sm text-ink">Weet u het zeker? Vul ter bevestiging uw wachtwoord in.</p>

            <x-field name="password" id="delete_password" label="Wachtwoord" type="password" bag="userDeletion" required autocomplete="current-password" />

            <div class="flex flex-wrap gap-3">
                <x-button type="submit">Ja, verwijder mijn account</x-button>
                <x-button variant="secondary" :href="route('profile.edit')">Annuleren</x-button>
            </div>
        </form>
    </details>
</section>
