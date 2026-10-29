<x-guest-layout>
    @section('title', 'Inloggen')
    <div class="ff-form-content ff-enter">
        <div class="ff-kicker"><span></span> WELKOM TERUG</div>
        <h1>Log in op je <em>account.</em></h1>
        <p class="ff-description">Voer je gegevens in om veilig verder te gaan.</p>

        @if (session('status'))
            <div class="ff-alert ff-alert-success" role="status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="ff-form" data-ff-form>
            @csrf
            <div class="ff-field">
                <label for="email">E-mailadres</label>
                <div class="ff-input-wrap @error('email') ff-input-error @enderror">
                    <svg aria-hidden="true"><use href="#ff-icon-mail"/></svg>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="naam@voorbeeld.nl" autocomplete="email" required autofocus>
                </div>
                @error('email') <p class="ff-error" role="alert">{{ $message }}</p> @enderror
            </div>

            <div class="ff-field">
                <div class="ff-label-row"><label for="password">Wachtwoord</label><a class="ff-text-link" href="{{ route('password.request') }}">Wachtwoord vergeten?</a></div>
                <div class="ff-input-wrap @error('password') ff-input-error @enderror">
                    <svg aria-hidden="true"><use href="#ff-icon-lock"/></svg>
                    <input id="password" type="password" name="password" placeholder="Vul je wachtwoord in" autocomplete="current-password" required>
                    <button type="button" class="ff-show-password" data-password-toggle="password" aria-label="Toon wachtwoord" aria-pressed="false"><svg aria-hidden="true"><use href="#ff-icon-eye"/></svg></button>
                </div>
                @error('password') <p class="ff-error" role="alert">{{ $message }}</p> @enderror
            </div>

            <label class="ff-checkbox-row"><input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}><span>Ingelogd blijven</span></label>
            <button type="submit" class="ff-btn ff-btn-primary"><span>Inloggen</span><span class="ff-btn-arrow" aria-hidden="true">↗</span></button>
        </form>
        <div class="ff-switch">Nog geen account? <a href="{{ route('register') }}">Maak een account aan <span aria-hidden="true">→</span></a></div>
        <div class="ff-form-trust"><svg aria-hidden="true"><use href="#ff-icon-lock"/></svg> Je verbinding is beveiligd</div>
    </div>
</x-guest-layout>
