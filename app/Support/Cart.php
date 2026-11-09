<?php

namespace App\Support;

/**
 * Winkelwagen, bewaard in de sessie (nog geen database).
 *
 * In de sessie staat alleen: slug van het product => aantal. Prijzen en namen halen we altijd opnieuw uit
 * App\Support\Catalog, zodat een bezoeker de prijs niet kan aanpassen.
 * Later (met de database en het afrekenen) komt de winkelwagen in een tabel; de pagina's kunnen dan blijven.
 */
class Cart
{
    private const SESSION_KEY = 'winkelwagen';

    /** Maximaal aantal van één product. */
    public const MAX_QUANTITY = 99;

    /**
     * Alle regels in de winkelwagen: slug => aantal. Producten die niet (meer) bestaan vallen weg.
     *
     * @return array<string, int>
     */
    public static function items(): array
    {
        $items = session(self::SESSION_KEY, []);

        return array_filter(
            is_array($items) ? $items : [],
            fn ($aantal, $slug) => is_string($slug) && is_int($aantal) && $aantal > 0 && Catalog::product($slug),
            ARRAY_FILTER_USE_BOTH,
        );
    }

    /** Voeg een product toe. Staat het er al in, dan telt het aantal op (tot het maximum). */
    public static function add(string $slug, int $aantal = 1): void
    {
        $items = self::items();

        self::set($slug, ($items[$slug] ?? 0) + $aantal);
    }

    /** Zet het aantal van een product. 0 of minder haalt het product weg. */
    public static function set(string $slug, int $aantal): void
    {
        $items = self::items();

        if ($aantal <= 0) {
            unset($items[$slug]);
        } else {
            $items[$slug] = min($aantal, self::MAX_QUANTITY);
        }

        session([self::SESSION_KEY => $items]);
    }

    public static function remove(string $slug): void
    {
        self::set($slug, 0);
    }

    /** Totaal aantal stuks (voor het getal bij het winkelwagen-icoon). */
    public static function count(): int
    {
        return array_sum(self::items());
    }

    /**
     * De regels met productgegevens, voor de pagina Winkelwagen.
     *
     * @return array<int, array{product: array<string, mixed>, quantity: int, subtotal: float}>
     */
    public static function lines(): array
    {
        $regels = [];

        foreach (self::items() as $slug => $aantal) {
            $product = Catalog::product($slug);
            $regels[] = ['product' => $product, 'quantity' => $aantal, 'subtotal' => $product['amount'] * $aantal];
        }

        return $regels;
    }

    public static function total(): float
    {
        return array_sum(array_column(self::lines(), 'subtotal'));
    }

    /**
     * De inhoud als korte tekst voor het offerteformulier, bijvoorbeeld "2× 4K IP-camera buiten, 1× NVR-recorder 8 kanalen".
     */
    public static function summary(): string
    {
        return implode(', ', array_map(
            fn (array $regel) => $regel['quantity'].'× '.$regel['product']['title'],
            self::lines(),
        ));
    }
}
