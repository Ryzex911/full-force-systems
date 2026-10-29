<x-guest-layout>
    @section('title', 'Nieuw wachtwoord')
    <div class="ff-form-content ff-enter">
        <div class="ff-step-symbol"><svg aria-hidden="true"><use href="#ff-icon-lock"/></svg></div>
        <div class="ff-kicker"><span></span> ACCOUNT HERSTELLEN</div>
        <h1>Nieuw <em>wachtwoord.</em></h1>
        <p class="ff-description">Kies een nieuw, sterk wachtwoord voor je account.</p>

        <form method="POST" action="{{ route('password.store') }}" class="ff-form" data-ff-form>
            @csrf
            <input type="hidden" name="token" value="{{ request()->route('token') }}">
            <div class="ff-field">
                <label for="email">E-mailadres</label>
                <div class="ff-input-wrap @error('email') ff-input-error @enderror"><svg aria-hidden="true"><use href="#ff-icon-mail"/></svg><input id="email" type="email" name="email" value="{{ old('email', request()->email) }}" autocomplete="email" required autofocus></div>
                @error('email') <p class="ff-error" role="alert">{{ $message }}</p> @enderror
            </div>
            <div class="ff-field">
                <label for="password">Nieuw wachtwoord</label>
                <div class="ff-input-wrap @error('password') ff-input-error @enderror"><svg aria-hidden="true"><use href="#ff-icon-lock"/></svg><input id="password" type="password" name="password" placeholder="Minimaal 8 tekens" autocomplete="new-password" required><button type="button" class="ff-show-password" data-password-toggle="password" aria-label="Toon wachtwoord" aria-pressed="false"><svg aria-hidden="true"><use href="#ff-icon-eye"/></svg></button></div>
                <div class="ff-password-strength" data-password-meter="password"><div class="ff-strength-bars"><i></i><i></i><i></i><i></i></div><span>Gebruik minimaal 8 tekens</span></div>
                @error('password') <p class="ff-error" role="alert">{{ $message }}</p> @enderror
            </div>
            <div class="ff-field">
                <label for="password_confirmation">Herhaal nieuw wachtwoord</label>
                <div class="ff-input-wrap"><svg aria-hidden="true"><use href="#ff-icon-lock"/></svg><input id="password_confirmation" type="password" name="password_confirmation" placeholder="Herhaal het nieuwe wachtwoord" autocomplete="new-password" required><button type="button" class="ff-show-password" data-password-toggle="password_confirmation" aria-label="Toon wachtwoord" aria-pressed="false"><svg aria-hidden="true"><use href="#ff-icon-eye"/></svg></button></div>
            </div>
            <button type="submit" class="ff-btn ff-btn-primary"><span>Wachtwoord opslaan</span><span class="ff-btn-arrow" aria-hidden="true">↗</span></button>
        </form>
        <div class="ff-switch"><a href="{{ route('login') }}"><span aria-hidden="true">←</span> Terug naar inloggen</a></div>
    </div>
</x-guest-layout>
