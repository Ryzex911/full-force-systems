<?php

namespace App\Http\Controllers;

use App\Support\Catalog;
use App\Support\Nav;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Toon de pagina Diensten met alle diensten onder elkaar.
     *
     * De diensten staan in config/site.php ('services'), omdat ze ook op de homepage en in de footer staan.
     * Zodra de database er is, kunnen ze uit een model komen.
     */
    public function index(): View
    {
        return view('pages.diensten', [
            'services' => config('site.services'),
            'audiences' => $this->audiences(),
        ]);
    }

    /**
     * Toon de detailpagina van één dienst (ontwerp: docs/ontwerp/03-dienst-detail.png).
     * Eén pagina voor alle vijf diensten; de inhoud komt uit config('site.services'). Onbekende dienst → 404.
     */
    public function show(string $slug): View
    {
        $service = collect(config('site.services'))->firstWhere('slug', $slug) ?? abort(404);

        return view('pages.dienst', [
            'service' => $service,
            'products' => Catalog::productsBySlug($service['products']),
        ]);
    }

    /**
     * De twee doelgroepen met hun hoofdactie uit het wensenformulier:
     * particulier → "Pakket bekijken", zakelijk → "Offerte aanvragen".
     */
    private function audiences(): array
    {
        return [
            [
                'icon' => 'home',
                'title' => 'Voor thuis',
                'text' => 'Kies een kant-en-klaar pakket met vaste prijs, of bestel losse producten in de webshop.',
                'points' => ['Vaste prijs inclusief installatie', 'Pakket aan te passen', 'Betalen met iDEAL of bankoverschrijving'],
                'button' => 'Pakket bekijken',
                'href' => route('pakketten'),
                'variant' => 'primary',
            ],
            [
                'icon' => 'building',
                'title' => 'Voor bedrijven',
                'text' => 'Wij komen langs, bekijken uw pand en maken een voorstel op maat met een heldere vanaf-prijs.',
                'points' => ['Advies op locatie', 'Voorstel op maat', 'Ook bestellen via de webshop'],
                'button' => 'Offerte aanvragen',
                'href' => Nav::quote(['klant' => 'zakelijk']),
                'variant' => 'secondary',
            ],
        ];
    }
}
