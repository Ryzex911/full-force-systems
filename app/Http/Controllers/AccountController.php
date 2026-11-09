<?php

namespace App\Http\Controllers;

use App\Support\ExampleAccount;
use App\Support\Favorites;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Mijn account (ontwerp 11): overzicht, bestellingen, aanvragen, favorieten en adressen.
 *
 * De naam, het e-mailadres en het accounttype zijn echt (uit de tabel users).
 * De favorieten staan in de sessie (App\Support\Favorites).
 * Bestellingen, aanvragen en adressen zijn nog VOORBEELDDATA (App\Support\ExampleAccount), tot de database er is.
 * Gegevens en wachtwoord wijzigen gebeurt op de profielpagina van Breeze (ProfileController).
 */
class AccountController extends Controller
{
    public function index(Request $request): View
    {
        $orders = ExampleAccount::orders();
        $quotes = ExampleAccount::quotes();

        return view('pages.account.index', [
            'orders' => $orders,
            'latestQuote' => $quotes[0] ?? null,
            'address' => collect(ExampleAccount::addresses($request->user()))->firstWhere('default', true),
            'stats' => [
                ['label' => 'Bestellingen', 'value' => count($orders), 'url' => route('account.bestellingen')],
                ['label' => 'Open aanvragen', 'value' => collect($quotes)->where('status', '!=', 'Geaccepteerd')->count(), 'url' => route('account.aanvragen')],
                ['label' => 'Favorieten', 'value' => count(Favorites::slugs()), 'url' => route('account.favorieten')],
            ],
        ]);
    }

    public function orders(): View
    {
        return view('pages.account.bestellingen', ['orders' => ExampleAccount::orders()]);
    }

    public function quotes(): View
    {
        return view('pages.account.aanvragen', ['quotes' => ExampleAccount::quotes()]);
    }

    public function favorites(): View
    {
        return view('pages.account.favorieten', ['products' => Favorites::products()]);
    }

    public function addresses(Request $request): View
    {
        return view('pages.account.adressen', ['addresses' => ExampleAccount::addresses($request->user())]);
    }
}
