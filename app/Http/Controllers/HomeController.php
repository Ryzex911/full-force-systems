<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Toon de homepage.
     *
     * Let op: de gegevens hieronder zijn tijdelijke voorbeelddata voor de front-end.
     * Zodra de database er is, komen pakketten, producten en projecten uit modellen.
     */
    public function __invoke(): View
    {
        return view('pages.home', [
            'usps' => $this->usps(),
            'packages' => $this->packages(),
            'steps' => $this->steps(),
            'projects' => $this->projects(),
            'products' => $this->products(),
            'partners' => ['Full Force Security', 'PNBS Security', 'Parabellen', 'Resecure', 'EMB Security', 'TaskTime'],
        ]);
    }

    /** Sterke punten uit het wensenformulier. */
    private function usps(): array
    {
        return [
            ['icon' => 'shield', 'text' => 'Praktijkervaring vanuit Full Force Security'],
            ['icon' => 'users', 'text' => 'Persoonlijk advies en maatwerk'],
            ['icon' => 'wrench', 'text' => 'Professionele installatie en duidelijke uitleg'],
            ['icon' => 'clock', 'text' => 'Snelle en persoonlijke service'],
        ];
    }

    /** VOORBEELD: definitieve pakketten en prijzen volgen van de opdrachtgever. */
    private function packages(): array
    {
        return [
            [
                'name' => 'Basis',
                'price' => '€ 899',
                'text' => 'Voor een appartement of tussenwoning.',
                'features' => ["2 buitencamera's", 'Recorder met opslag', 'Installatie en uitleg'],
                'featured' => false,
            ],
            [
                'name' => 'Plus',
                'price' => '€ 1.499',
                'text' => 'Voor een vrijstaande woning met tuin.',
                'features' => ["4 buitencamera's", 'Recorder met opslag', 'Alarmsysteem met sensoren', 'Installatie en uitleg'],
                'featured' => true,
            ],
            [
                'name' => 'Compleet',
                'price' => '€ 2.299',
                'text' => 'Camera, alarm en video-intercom in één.',
                'features' => ["4 buitencamera's", 'Alarmsysteem met sensoren', 'Video-intercom', 'Installatie en uitleg'],
                'featured' => false,
            ],
        ];
    }

    /** Werkwijze uit het wensenformulier: voorstel, akkoord, afspraak, installatie. */
    private function steps(): array
    {
        return [
            ['title' => 'Voorstel', 'text' => 'U vertelt wat u wilt beveiligen. Wij adviseren en sturen een duidelijk voorstel met prijs.'],
            ['title' => 'Akkoord', 'text' => 'Past het voorstel? Dan bevestigt u en leggen we alles vast.'],
            ['title' => 'Afspraak', 'text' => 'We plannen de installatie op een moment dat u uitkomt.'],
            ['title' => 'Installatie', 'text' => 'Wij monteren, stellen af en leggen uit hoe alles werkt.'],
        ];
    }

    /** Alleen "Tax administraties" is een echt project; de andere twee zijn VOORBEELDEN. */
    private function projects(): array
    {
        return [
            [
                'tag' => 'Camera + alarm',
                'title' => 'Tax administraties',
                'location' => 'Beuningen (GLD)',
                'image' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=800&q=70',
                'alt' => 'Kantoorgang met glazen wanden',
            ],
            [
                'tag' => 'Camerabewaking',
                'title' => 'Winkelpand (voorbeeld)',
                'location' => 'Locatie volgt',
                'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=800&q=70',
                'alt' => 'Interieur van een kledingwinkel',
            ],
            [
                'tag' => 'Alarmsysteem',
                'title' => 'Woonhuis (voorbeeld)',
                'location' => 'Locatie volgt',
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=70',
                'alt' => 'Moderne woning in de avond',
            ],
        ];
    }

    /** VOORBEELD: echte producten, prijzen en foto's volgen van de opdrachtgever. */
    private function products(): array
    {
        return [
            [
                'icon' => 'camera',
                'category' => "Camera's",
                'title' => '4K IP-camera buiten',
                'price' => '€ 199,00',
                'image' => 'https://images.unsplash.com/photo-1557597774-9d273605dfa9?auto=format&fit=crop&w=600&q=70',
            ],
            ['icon' => 'recorder', 'category' => 'Recorders', 'title' => 'NVR-recorder 8 kanalen', 'price' => '€ 249,00', 'image' => null],
            ['icon' => 'alarm', 'category' => 'Alarmsystemen', 'title' => 'Draadloze alarmset', 'price' => '€ 349,00', 'image' => null],
            ['icon' => 'intercom', 'category' => 'Intercom', 'title' => 'Video-deurbel met monitor', 'price' => '€ 279,00', 'image' => null],
        ];
    }
}
