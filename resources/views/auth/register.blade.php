<x-guest-layout>
    @section('title', 'Account aanmaken')
    <div class="ff-form-content ff-enter">
        <div class="ff-kicker"><span></span> NIEUW ACCOUNT</div>
        <h1>Maak een <em>account.</em></h1>
        <p class="ff-description">Registreer je als particulier of zakelijk klant.</p>

        <form method="POST" action="{{ route('register') }}" class="ff-form" data-ff-form>
            @csrf
            <fieldset class="ff-account-switch">
                <legend>Wat voor klant ben je?</legend>
                <div class="ff-account-options">
                    <label class="ff-account-option">
                        <input type="radio" name="account_type" value="particulier" {{ old('account_type', 'particulier') === 'particulier' ? 'checked' : '' }} required>
                        <span class="ff-option-card"><svg aria-hidden="true"><use href="#ff-icon-user"/></svg><span><strong>Particulier</strong><small>Voor jezelf</small></span><span class="ff-radio-indicator"></span></span>
                    </label>
                    <label class="ff-account-option">
                        <input type="radio" name="account_type" value="zakelijk" {{ old('account_type') === 'zakelijk' ? 'checked' : '' }} required>
                        <span class="ff-option-card"><svg aria-hidden="true"><use href="#ff-icon-building"/></svg><span><strong>Zakelijk</strong><small>Voor je bedrijf</small></span><span class="ff-radio-indicator"></span></span>
                    </label>
                </div>
                @error('account_type') <p class="ff-error" role="alert">{{ $message }}</p> @enderror
            </fieldset>

            <div class="ff-field" id="ff-company-field" hidden>
                <label for="company_name">Bedrijfsnaam <span class="ff-required">*</span></label>
                <div class="ff-input-wrap @error('company_name') ff-input-error @enderror"><svg aria-hidden="true"><use href="#ff-icon-building"/></svg><input id="company_name" name="company_name" type="text" value="{{ old('company_name') }}" placeholder="Naam van je bedrijf" autocomplete="organization" maxlength="255"></div>
                @error('company_name') <p class="ff-error" role="alert">{{ $message }}</p> @enderror
            </div>

            <div class="ff-field">
                <label for="name">Volledige naam</label>
                <div class="ff-input-wrap @error('name') ff-input-error @enderror"><svg aria-hidden="true"><use href="#ff-icon-user"/></svg><input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Voor- en achternaam" autocomplete="name" maxlength="255" required></div>
                @error('name') <p class="ff-error" role="alert">{{ $message }}</p> @enderror
            </div>

            <div class="ff-field">
                <label for="email">E-mailadres</label>
                <div class="ff-input-wrap @error('email') ff-input-error @enderror"><svg aria-hidden="true"><use href="#ff-icon-mail"/></svg><input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="naam@voorbeeld.nl" autocomplete="email" maxlength="255" required></div>
                @error('email') <p class="ff-error" role="alert">{{ $message }}</p> @enderror
            </div>

            <div class="ff-field">
                <label for="password">Wachtwoord</label>
                <div class="ff-input-wrap @error('password') ff-input-error @enderror"><svg aria-hidden="true"><use href="#ff-icon-lock"/></svg><input id="password" name="password" type="password" placeholder="Kies een sterk wachtwoord" autocomplete="new-password" required><button type="button" class="ff-show-password" data-password-toggle="password" aria-label="Toon wachtwoord" aria-pressed="false"><svg aria-hidden="true"><use href="#ff-icon-eye"/></svg></button></div>
                <div class="ff-password-strength" data-password-meter="password"><div class="ff-strength-bars"><i></i><i></i><i></i><i></i></div><span>Gebruik minimaal 8 tekens</span></div>
                @error('password') <p class="ff-error" role="alert">{{ $message }}</p> @enderror
            </div>

            <div class="ff-field">
                <label for="password_confirmation">Herhaal wachtwoord</label>
                <div class="ff-input-wrap"><svg aria-hidden="true"><use href="#ff-icon-lock"/></svg><input id="password_confirmation" name="password_confirmation" type="password" placeholder="Herhaal je wachtwoord" autocomplete="new-password" required><button type="button" class="ff-show-password" data-password-toggle="password_confirmation" aria-label="Toon wachtwoord" aria-pressed="false"><svg aria-hidden="true"><use href="#ff-icon-eye"/></svg></button></div>
            </div>
            <button type="submit" class="ff-btn ff-btn-primary"><span>Account aanmaken</span><span class="ff-btn-arrow" aria-hidden="true">↗</span></button>
        </form>
        <div class="ff-switch">Heb je al een account? <a href="{{ route('login') }}">Log hier in <span aria-hidden="true">→</span></a></div>
    </div>
</x-guest-layout>
