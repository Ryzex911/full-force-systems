{{-- E-mail aan Full Force Systems met een nieuwe offerteaanvraag (App\Mail\QuoteRequested). --}}
<x-mail::message>
# Nieuwe offerteaanvraag

Via de website is een aanvraag binnengekomen. Antwoorden kan direct met "Beantwoorden".

<x-mail::table>
| Gegeven | Ingevuld |
|:--|:--|
| Particulier of zakelijk | {{ ucfirst($aanvraag['klanttype']) }} |
| Naam | {{ $aanvraag['naam'] }} |
| Bedrijfsnaam | {{ $aanvraag['bedrijfsnaam'] ?: '–' }} |
| E-mail | {{ $aanvraag['email'] }} |
| Telefoon | {{ $aanvraag['telefoon'] ?: '–' }} |
| Postcode / plaats | {{ $aanvraag['postcode_plaats'] ?: '–' }} |
| Gewenste dienst | {{ $aanvraag['dienst'] ?: '–' }} |
| Product(en) | {{ $aanvraag['producten'] ?: '–' }} |
</x-mail::table>

**Omschrijving**

{{ $aanvraag['omschrijving'] }}
</x-mail::message>
