<?php

namespace App\Support;

/**
 * Favoriete producten, bewaard in de sessie (nog geen database).
 *
 * Werkt ook zonder account. Later, met de database, slaan we de favorieten op bij het account,
 * zodat ze ook na uitloggen of op een andere computer blijven staan.
 */
class Favorites
{
    private const SESSION_KEY = 'favorieten';

    /**
     * Slugs van de favoriete producten, in de volgorde waarin ze zijn toegevoegd.
     *
     * @return array<int, string>
     */
    public static function slugs(): array
    {
        $slugs = session(self::SESSION_KEY, []);

        return array_values(array_filter(
            is_array($slugs) ? $slugs : [],
            fn ($slug) => is_string($slug) && Catalog::product($slug),
        ));
    }

    public static function has(string $slug): bool
    {
        return in_array($slug, self::slugs(), true);
    }

    /**
     * Zet een product op de lijst of haal het eraf.
     *
     * @return bool true als het product nu een favoriet is
     */
    public static function toggle(string $slug): bool
    {
        $slugs = self::slugs();
        $isFavoriet = ! in_array($slug, $slugs, true);

        $slugs = $isFavoriet ? [...$slugs, $slug] : array_values(array_diff($slugs, [$slug]));
        session([self::SESSION_KEY => $slugs]);

        return $isFavoriet;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function products(): array
    {
        return Catalog::productsBySlug(self::slugs());
    }
}
