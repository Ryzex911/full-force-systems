{{-- Wachtwoord wijzigen (Auth\PasswordController@update). Foutmeldingen staan in de error bag 'updatePassword'. --}}
<section id="wachtwoord" class="card scroll-mt-36 flex flex-col gap-6 p-6 sm:p-8">
    <header class="flex flex-col gap-1">
        <h2 class="text-h3 text-ink">Wachtwoord wijzigen</h2>
        <p class="text-body-sm text-ink-2">Kies een lang wachtwoord dat u nergens anders gebruikt.</p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="flex max-w-[560px] flex-col gap-5">
        @csrf
        @method('put')

        <x-field name="current_password" id="update_password_current_password" label="Huidig wachtwoord" type="password" bag="updatePassword" required autocomplete="current-password" />
        <x-field name="password" id="update_password_password" label="Nieuw wachtwoord" type="password" bag="updatePassword" required autocomplete="new-password" />
        <x-field name="password_confirmation" id="update_password_password_confirmation" label="Herhaal nieuw wachtwoord" type="password" bag="updatePassword" required autocomplete="new-password" />

        <div class="flex flex-wrap items-center gap-4">
            <x-button type="submit">Wachtwoord opslaan</x-button>

            @if (session('status') === 'password-updated')
                <p class="text-body-sm flex items-center gap-1.5 text-ok" role="status">
                    <x-icon name="check-circle" class="size-4" />
                    Uw wachtwoord is gewijzigd.
                </p>
            @endif
        </div>
    </form>
</section>
