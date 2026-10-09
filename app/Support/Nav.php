<?php

namespace App\Support;

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
}
