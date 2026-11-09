<?php

namespace App\Http\Controllers;

use App\Support\Catalog;
use App\Support\Favorites;
use Illuminate\Http\RedirectResponse;

/**
 * Het hartje bij een product: zet het product op de favorietenlijst of haal het eraf.
 * De lijst staat in de sessie (zie App\Support\Favorites) en is te zien in Mijn account → Favorieten.
 */
class FavoriteController extends Controller
{
    public function __invoke(string $slug): RedirectResponse
    {
        $product = Catalog::product($slug) ?? abort(404);

        $tekst = Favorites::toggle($slug)
            ? $product['title'].' staat bij uw favorieten.'
            : $product['title'].' is van uw favorieten gehaald.';

        return back()->with('melding', ['tekst' => $tekst]);
    }
}
