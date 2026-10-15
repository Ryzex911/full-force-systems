<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;

class Nav
{
    /**
     * Geef de link voor een menu-item uit config('site.nav').
     *
     * Volgorde: eigen pagina (route) → blok op de homepage (anchor) → '#'.
     */
    public static function href(array $item): string
    {
        if (! empty($item['route'])) {
            return route($item['route']);
        }

        if (! empty($item['anchor'])) {
            return route('home').'#'.$item['anchor'];
        }

        return '#';
    }

    /**
     * Geef de link naar een pagina, of null als die pagina (route) nog niet bestaat.
     *
     * Zo tonen we geen knoppen die nergens heen gaan. Gebruik in Blade:
     *
     *   @if ($link = Nav::page('webshop')) <a href="{{ $link }}">Naar de webshop</a> @endif
     * Zodra je de route 'webshop' toevoegt in routes/web.php, verschijnt de link vanzelf.
     */
    public static function page(string $route, array $parameters = []): ?string
    {
        return Route::has($route) ? route($route, $parameters) : null;
    }

    /**
     * Link naar het offerteformulier, eventueel met een vooraf ingevulde keuze.
     * Bijvoorbeeld: Nav::quote(['dienst' => 'camerabewaking']) of Nav::quote(['pakket' => 'Plus']).
     */
    public static function quote(array $prefill = []): string
    {
        return route('contact', $prefill).'#offerteformulier';
    }
}
