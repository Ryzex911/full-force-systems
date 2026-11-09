{{-- Naam en e-mailadres wijzigen (ProfileController@update). Bij een nieuw e-mailadres moet de klant het opnieuw bevestigen. --}}
<section id="gegevens" class="card scroll-mt-36 flex flex-col gap-6 p-6 sm:p-8">
    <header class="flex flex-col gap-1">
        <h2 class="text-h3 text-ink">Uw gegevens</h2>
        <p class="text-body-sm text-ink-2">Pas uw naam en e-mailadres aan.</p>
    </header>

    {{-- Los formulier voor "bevestigingsmail opnieuw sturen"; de knop staat verderop (form="send-verification") --}}
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="flex max-w-[560px] flex-col gap-5">
        @csrf
        @method('patch')

        <x-field name="name" label="Naam" :value="$user->name" required autocomplete="name" />

        <div class="flex flex-col gap-3">
            <x-field name="email" label="E-mailadres" type="email" :value="$user->email" required autocomplete="username" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="text-body-sm flex flex-col gap-2 rounded-lg bg-surface-2 p-4 text-ink-2">
                    <p>
                        Uw e-mailadres is nog niet bevestigd.
                        <button form="send-verification" class="font-semibold text-brand-ink hover:underline">Stuur de bevestigingsmail opnieuw.</button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="font-semibold text-ok">Er is een nieuwe bevestigingslink naar uw e-mailadres gestuurd.</p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Accounttype: wordt gekozen bij het registreren --}}
        <dl class="text-body-sm flex flex-col gap-1">
            <dt class="font-semibold text-ink">Accounttype</dt>
            <dd class="text-ink-2">
                {{ $user->account_type === 'zakelijk' ? 'Zakelijk' : 'Particulier' }}@if ($user->company_name) · {{ $user->company_name }}@endif
                <span class="text-ink-3">— wilt u dit wijzigen? Neem contact met ons op.</span>
            </dd>
        </dl>

        <div class="flex flex-wrap items-center gap-4">
            <x-button type="submit">Opslaan</x-button>

            @if (session('status') === 'profile-updated')
                <p class="text-body-sm flex items-center gap-1.5 text-ok" role="status">
                    <x-icon name="check-circle" class="size-4" />
                    Opgeslagen.
                </p>
            @endif
        </div>
    </form>
</section>
