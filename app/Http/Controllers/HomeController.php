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
            'projects' => Catalog::projects(),
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
}
