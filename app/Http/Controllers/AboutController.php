<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Toon de pagina Over ons.
     *
     * De teksten komen uit het wensenformulier van de opdrachtgever (vraag 6: geschiedenis, missie en sterke punten).
     * Volgens het formulier komen er geen medewerkers en geen klantreviews op de site.
     */
    public function __invoke(): View
    {
        return view('pages.over-ons', [
            'history' => [
                'Full Force Systems is een gespecialiseerd onderdeel van Full Force Security, een beveiligingsorganisatie die al meerdere jaren actief is binnen de particuliere beveiligingsbranche.',
                'Vanuit onze dagelijkse praktijk ontstond steeds vaker de vraag naar betrouwbare camera-, alarm- en toegangscontrolesystemen. Met Full Force Systems combineren wij onze ervaring in fysieke beveiliging met moderne beveiligingstechniek.',
                'Hierdoor kunnen wij klanten voorzien van één complete beveiligingsoplossing, van advies en installatie tot beheer en ondersteuning.',
            ],
            'mission' => [
                'Full Force Systems staat voor betrouwbare, gebruiksvriendelijke en professioneel geïnstalleerde beveiligingstechniek. Onze missie is om woningen en bedrijfspanden veiliger te maken met oplossingen die volledig aansluiten op de situatie en wensen van de klant.',
                'Wij kijken niet alleen naar de techniek, maar vooral naar wat er in de praktijk nodig is om risico’s effectief te beperken.',
            ],
            'strengths' => $this->strengths(),
            'partners' => config('site.partners'),
        ]);
    }

    /** "Waarom kiezen klanten voor jullie?" uit het wensenformulier. */
    private function strengths(): array
    {
        return [
            ['icon' => 'shield', 'text' => 'Praktijkervaring vanuit Full Force Security'],
            ['icon' => 'users', 'text' => 'Persoonlijk advies en maatwerk'],
            ['icon' => 'lock', 'text' => 'Eén aanspreekpunt voor fysieke én technische beveiliging'],
            ['icon' => 'wrench', 'text' => 'Professionele installatie en duidelijke uitleg'],
            ['icon' => 'camera', 'text' => 'Betrouwbare camera-, alarm- en toegangscontrolesystemen'],
            ['icon' => 'clock', 'text' => 'Snelle en persoonlijke service'],
            ['icon' => 'building', 'text' => 'Oplossingen voor zowel particulieren als bedrijven'],
            ['icon' => 'check', 'text' => 'Geen onnodig ingewikkelde systemen of overbodige kosten'],
        ];
    }
}
