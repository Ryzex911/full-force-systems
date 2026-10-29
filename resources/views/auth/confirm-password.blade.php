<x-guest-layout>
    @section('title', 'Wachtwoord bevestigen')
    <div class="ff-form-content ff-enter">
        <div class="ff-step-symbol"><svg aria-hidden="true"><use href="#ff-icon-lock"/></svg></div>
        <div class="ff-kicker"><span></span> VEILIGHEIDSCONTROLE</div>
        <h1>Bevestig je <em>wachtwoord.</em></h1>
        <p class="ff-description">Voor deze beveiligde actie vragen we je om je wachtwoord opnieuw in te vullen.</p>
        <form method="POST" action="{{ route('password.confirm') }}" class="ff-form" data-ff-form>
            @csrf
            <div class="ff-field">
                <label for="password">Wachtwoord</label>
                <div class="ff-input-wrap @error('password') ff-input-error @enderror"><svg aria-hidden="true"><use href="#ff-icon-lock"/></svg><input id="password" type="password" name="password" placeholder="Vul je wachtwoord in" autocomplete="current-password" required autofocus><button type="button" class="ff-show-password" data-password-toggle="password" aria-label="Toon wachtwoord" aria-pressed="false"><svg aria-hidden="true"><use href="#ff-icon-eye"/></svg></button></div>
                @error('password') <p class="ff-error" role="alert">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="ff-btn ff-btn-primary"><span>Bevestigen</span><span class="ff-btn-arrow" aria-hidden="true">↗</span></button>
        </form>
    </div>
</x-guest-layout>
