<x-guest-layout>
    @section('title', 'E-mailadres verifiëren')
    <div class="ff-form-content ff-enter">
        <div class="ff-step-symbol"><svg aria-hidden="true"><use href="#ff-icon-mail"/></svg></div>
        <div class="ff-kicker"><span></span> LAATSTE STAP</div>
        <h1>Bevestig uw <em>e-mailadres.</em></h1>
        <p class="ff-description">We hebben u een verificatielink gestuurd. Klik op de link in uw inbox om uw account te activeren. Geen mail ontvangen? Vraag een nieuwe aan.</p>
        @if (session('status') == 'verification-link-sent')
            <div class="ff-alert ff-alert-success" role="status">Er is een nieuwe verificatielink naar uw e-mailadres gestuurd.</div>
        @endif
        <form method="POST" action="{{ route('verification.send') }}" class="ff-form" data-ff-form>
            @csrf
            <button type="submit" class="ff-btn ff-btn-primary"><span>Verificatielink opnieuw versturen</span><span class="ff-btn-arrow" aria-hidden="true">↗</span></button>
        </form>
        <form method="POST" action="{{ route('logout') }}" class="ff-secondary-form">
            @csrf
            <button type="submit" class="ff-btn ff-btn-outline">Uitloggen</button>
        </form>
    </div>
</x-guest-layout>
