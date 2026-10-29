<?php

namespace App\Http\Controllers;

use App\Support\Catalog;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Toon de homepage.
     *
     * Let op: de gegevens zijn tijdelijke voorbeelddata voor de front-end. Pakketten en producten staan
     * in App\Support\Catalog, omdat ze ook op andere pagina's staan. Zodra de database er is, komen ze uit modellen.
     */
    public function __invoke(): View
    {
        return view('pages.home', [
            'usps' => $this->usps(),
            'packages' => Catalog::packages(),
            'projects' => $this->projects(),
            'products' => array_values(array_filter(Catalog::products(), fn ($product) => $product['featured'])),
            'partners' => array_slice(config('site.partners'), 0, 6),
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

    /** Alleen "Tax administraties" is een echt project; de andere twee zijn VOORBEELDEN. */
    private function projects(): array
    {
        return [
            [
                'tag' => 'Camera + alarm',
                'title' => 'Tax administraties',
                'location' => 'Beuningen (GLD)',
                'image' => asset('images/voorbeeld/project-kantoor.jpg'),
                'alt' => 'Kantoorgang met glazen wanden',
            ],
            [
                'tag' => 'Camerabewaking',
                'title' => 'Winkelpand (voorbeeld)',
                'location' => 'Locatie volgt',
                'image' => asset('images/voorbeeld/project-winkel.jpg'),
                'alt' => 'Interieur van een kledingwinkel',
            ],
            [
                'tag' => 'Alarmsysteem',
                'title' => 'Woonhuis (voorbeeld)',
                'location' => 'Locatie volgt',
                'image' => asset('images/voorbeeld/project-woonhuis.jpg'),
                'alt' => 'Moderne woning in de avond',
            ],
        ];
    }
}
