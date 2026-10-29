{{-- Automatische bevestiging aan de klant (App\Mail\QuoteReceived). --}}
<x-mail::message>
# Bedankt voor uw aanvraag, {{ $aanvraag['naam'] }}

Wij hebben uw aanvraag goed ontvangen. Wij bekijken uw situatie en nemen persoonlijk contact met u op.

**Zo gaat het verder**

@foreach (config('site.steps') as $nummer => $stap)
{{ $nummer + 1 }}. **{{ $stap['title'] }}** – {{ $stap['text'] }}
@endforeach

Liever direct contact? Bel ons op {{ config('site.phone') }} ({{ strtolower(config('site.hours')) }}) of antwoord op deze e-mail.

Met vriendelijke groet,<br>
{{ config('site.name') }}
</x-mail::message>
