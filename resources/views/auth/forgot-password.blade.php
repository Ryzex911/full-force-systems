<x-guest-layout>
    @section('title', 'Wachtwoord vergeten')
    <div class="ff-form-content ff-enter">
        <div class="ff-step-symbol"><svg aria-hidden="true"><use href="#ff-icon-lock"/></svg></div>
        <div class="ff-kicker"><span></span> ACCOUNT HERSTELLEN</div>
        <h1>Wachtwoord <em>vergeten?</em></h1>
        <p class="ff-description">Geen probleem. Vul je e-mailadres in. Je ontvangt een link om een nieuw wachtwoord in te stellen.</p>

        @if (session('status')) <div class="ff-alert ff-alert-success" role="status">{{ session('status') }}</div> @endif

        <form method="POST" action="{{ route('password.email') }}" class="ff-form" data-ff-form>
            @csrf
            <div class="ff-field">
                <label for="email">E-mailadres</label>
                <div class="ff-input-wrap @error('email') ff-input-error @enderror"><svg aria-hidden="true"><use href="#ff-icon-mail"/></svg><input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="naam@voorbeeld.nl" autocomplete="email" required autofocus></div>
                @error('email') <p class="ff-error" role="alert">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="ff-btn ff-btn-primary"><span>Verstuur herstellink</span><span class="ff-btn-arrow" aria-hidden="true">↗</span></button>
        </form>
        <div class="ff-switch"><a href="{{ route('login') }}"><span aria-hidden="true">←</span> Terug naar inloggen</a></div>
    </div>
</x-guest-layout>
