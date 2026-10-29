<?php

namespace App\Support;

/**
 * VOORBEELDDATA voor pakketten en producten.
 *
 * Deze gegevens staan op meerdere pagina's (home, pakketten, webshop, dienst detail), daarom op één plek.
 * De echte pakketten, producten en prijzen volgen van de opdrachtgever; later komen ze uit de database.
 */
class Catalog
{
    /**
     * De zes webshopcategorieën uit het wensenformulier (vraag 8), met het icoon voor producten zonder foto.
     *
     * @return array<string, array{label: string, icon: string}>
     */
    public static function categories(): array
    {
        return [
            'cameras' => ['label' => "Camera's", 'icon' => 'camera'],
            'recorders' => ['label' => 'Recorders', 'icon' => 'recorder'],
            'kabels-accessoires' => ['label' => 'Kabels & accessoires', 'icon' => 'cable'],
            'alarmsystemen' => ['label' => 'Alarmsystemen', 'icon' => 'alarm'],
            'toegangscontrole' => ['label' => 'Toegangscontrole', 'icon' => 'lock'],
            'intercom' => ['label' => 'Intercom', 'icon' => 'intercom'],
        ];
    }

    /**
     * VOORBEELD: de drie pakketten voor particulieren.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function packages(): array
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

    /**
     * VOORBEELD: de vergelijkingstabel op de pagina Pakketten.
     * Per rij één waarde per pakket (Basis, Plus, Compleet): true = vinkje, false = streepje, tekst = die tekst.
     *
     * @return array<int, array{label: string, values: array<int, bool|string>}>
     */
    public static function comparison(): array
    {
        return [
            ['label' => "Buitencamera's", 'values' => ['2', '4', '4']],
            ['label' => 'Recorder met opslag', 'values' => [true, true, true]],
            ['label' => 'Alarmsysteem met sensoren', 'values' => [false, true, true]],
            ['label' => 'Video-intercom', 'values' => [false, false, true]],
            ['label' => 'Installatie en uitleg', 'values' => [true, true, true]],
            ['label' => 'Onderhoud & service', 'values' => ['Optioneel', 'Optioneel', 'Optioneel']],
        ];
    }

    /**
     * VOORBEELD: alle producten, in de volgorde "populair" (zoals in het webshopontwerp).
     *
     * Elk product heeft de sleutels die x-product-card nodig heeft (icon, category, title, price, image)
     * plus gegevens om te filteren en sorteren (slug, category_slug, amount, in_stock, offer).
     * 'featured' = staat op de homepage.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function products(): array
    {
        $producten = [
            ['slug' => '4k-ip-camera-buiten', 'title' => '4K IP-camera buiten', 'category' => 'cameras', 'amount' => 199.00, 'image' => 'camera.jpg', 'featured' => true],
            ['slug' => 'dome-camera-binnen', 'title' => 'Dome-camera binnen', 'category' => 'cameras', 'amount' => 129.00],
            ['slug' => 'nvr-recorder-8-kanalen', 'title' => 'NVR-recorder 8 kanalen', 'category' => 'recorders', 'amount' => 249.00, 'featured' => true],
            ['slug' => 'nvr-recorder-16-kanalen', 'title' => 'NVR-recorder 16 kanalen', 'category' => 'recorders', 'amount' => 399.00],
            ['slug' => 'draadloze-alarmset', 'title' => 'Draadloze alarmset', 'category' => 'alarmsystemen', 'amount' => 349.00, 'featured' => true],
            ['slug' => 'bewegingsmelder', 'title' => 'Bewegingsmelder', 'category' => 'alarmsystemen', 'amount' => 49.00],
            ['slug' => 'codeklavier-met-taglezer', 'title' => 'Codeklavier met taglezer', 'category' => 'toegangscontrole', 'amount' => 159.00, 'image' => 'codeklavier.jpg'],
            ['slug' => 'video-deurbel-met-monitor', 'title' => 'Video-deurbel met monitor', 'category' => 'intercom', 'amount' => 279.00, 'featured' => true],
            ['slug' => 'netwerkkabel-cat6-50-m', 'title' => 'Netwerkkabel CAT6 50 m', 'category' => 'kabels-accessoires', 'amount' => 39.00],
        ];

        $categorieen = self::categories();

        return array_map(fn (array $product) => [
            'slug' => $product['slug'],
            'title' => $product['title'],
            'category_slug' => $product['category'],
            'category' => $categorieen[$product['category']]['label'],
            'icon' => $categorieen[$product['category']]['icon'],
            'amount' => $product['amount'],
            'price' => self::euro($product['amount']),
            'image' => isset($product['image']) ? asset('images/voorbeeld/'.$product['image']) : null,
            'in_stock' => $product['in_stock'] ?? true,
            'offer' => $product['offer'] ?? false,
            'featured' => $product['featured'] ?? false,
        ], $producten);
    }

    /**
     * Uitgevoerde projecten (homepage en pagina Projecten).
     * Alleen "Tax administraties" is echt (wensenformulier, vraag 13); de andere twee zijn VOORBEELDEN.
     * 'services' = slugs uit config('site.services'), voor het filter op de pagina Projecten.
     * De foto's zijn tijdelijk (Unsplash); de opdrachtgever levert eigen projectfoto's.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function projects(): array
    {
        return [
            [
                'slug' => 'tax-administraties',
                'tag' => 'Camera + alarm',
                'title' => 'Tax administraties',
                'location' => 'Beuningen (GLD)',
                'text' => 'Installatie van een camera- en alarmsysteem voor een kantoor in Beuningen.',
                'services' => ['camerabewaking', 'alarmsystemen'],
                'type' => 'Zakelijk',
                'image' => asset('images/voorbeeld/project-kantoor.jpg'),
                'alt' => 'Kantoorgang met glazen wanden',
                'featured' => true,
            ],
            [
                'slug' => 'winkelpand',
                'tag' => 'Camerabewaking',
                'title' => 'Winkelpand (voorbeeld)',
                'location' => 'Locatie volgt',
                'text' => null,
                'services' => ['camerabewaking'],
                'type' => 'Zakelijk',
                'image' => asset('images/voorbeeld/project-winkel.jpg'),
                'alt' => 'Interieur van een kledingwinkel',
                'featured' => false,
            ],
            [
                'slug' => 'woonhuis',
                'tag' => 'Alarmsysteem',
                'title' => 'Woonhuis (voorbeeld)',
                'location' => 'Locatie volgt',
                'text' => null,
                'services' => ['alarmsystemen'],
                'type' => 'Particulier',
                'image' => asset('images/voorbeeld/project-woonhuis.jpg'),
                'alt' => 'Moderne woning in de avond',
                'featured' => false,
            ],
        ];
    }

    /**
     * Producten zoeken op slug, in de volgorde waarin je ze vraagt. Onbekende slugs worden overgeslagen.
     *
     * @param  array<int, string>  $slugs
     * @return array<int, array<string, mixed>>
     */
    public static function productsBySlug(array $slugs): array
    {
        $alle = array_column(self::products(), null, 'slug');

        return array_values(array_filter(array_map(fn ($slug) => $alle[$slug] ?? null, $slugs)));
    }

    /** Bedrag als Nederlandse prijs: 1499.5 → "€ 1.499,50". */
    public static function euro(float $bedrag): string
    {
        return '€ '.number_format($bedrag, 2, ',', '.');
    }
}
