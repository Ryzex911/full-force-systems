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
        ] + self::details($product['slug']), $producten);
    }

    /**
     * Eén product op slug (voor de productpagina /webshop/{slug}), of null als het niet bestaat.
     *
     * @return array<string, mixed>|null
     */
    public static function product(string $slug): ?array
    {
        return self::productsBySlug([$slug])[0] ?? null;
    }

    /**
     * VOORBEELD: de teksten en specificaties voor de productpagina (ontwerp 06).
     * text = korte tekst onder de prijs, heading + description + features = tab "Beschrijving",
     * specs = tabel "Specificaties", related = slugs voor "Vaak samen gekocht".
     *
     * @return array{text: string, heading: string, description: string, features: array<int, string>, specs: array<string, string>, related: array<int, string>}
     */
    private static function details(string $slug): array
    {
        $details = [
            '4k-ip-camera-buiten' => [
                'text' => 'Weerbestendige buitencamera met scherp beeld bij dag en nacht. Geschikt voor woning en bedrijfspand en te koppelen aan een recorder.',
                'heading' => 'Scherp beeld, ook in het donker',
                'description' => 'Deze buitencamera levert gedetailleerd beeld en is bestand tegen regen en vorst. U sluit hem aan op een recorder en bekijkt de beelden wanneer u wilt.',
                'features' => ['Geschikt voor buiten', 'Aan te sluiten op een recorder', 'Montagemateriaal meegeleverd'],
                'specs' => ['Resolutie' => '4K (8 MP)', 'Nachtzicht' => 'Tot 30 meter', 'Behuizing' => 'IP67, geschikt voor buiten', 'Voeding' => 'PoE (via netwerkkabel)', 'Opslag' => 'Via recorder (NVR)'],
                'related' => ['nvr-recorder-8-kanalen', 'netwerkkabel-cat6-50-m', 'dome-camera-binnen', 'bewegingsmelder'],
            ],
            'dome-camera-binnen' => [
                'text' => 'Compacte camera voor binnen, voor winkel, kantoor of hal. Valt weinig op en geeft een breed overzicht.',
                'heading' => 'Overzicht in de hele ruimte',
                'description' => 'De dome-camera hangt aan het plafond en ziet de hele ruimte. Hij is klein en rustig van vorm, dus hij past in elk interieur.',
                'features' => ['Breed beeld', 'Plafondmontage', 'Aan te sluiten op een recorder'],
                'specs' => ['Resolutie' => '4 MP', 'Nachtzicht' => 'Tot 20 meter', 'Behuizing' => 'Voor binnen', 'Voeding' => 'PoE (via netwerkkabel)', 'Opslag' => 'Via recorder (NVR)'],
                'related' => ['nvr-recorder-8-kanalen', 'netwerkkabel-cat6-50-m', '4k-ip-camera-buiten', 'bewegingsmelder'],
            ],
            'nvr-recorder-8-kanalen' => [
                'text' => 'Recorder voor maximaal 8 camera\'s. Slaat de beelden op en u bekijkt ze op uw telefoon of computer.',
                'heading' => 'Al uw beelden op één plek',
                'description' => 'De recorder neemt de beelden van al uw camera\'s op. Met de app kijkt u live mee of zoekt u terug wat er is gebeurd.',
                'features' => ['Voor maximaal 8 camera\'s', 'Beelden terugkijken via de app', 'Camera\'s krijgen stroom via de netwerkkabel'],
                'specs' => ['Kanalen' => '8', 'Opslag' => 'Harde schijf 2 TB', 'Aansluiting camera\'s' => '8 × PoE', 'Beeld bekijken' => 'App en computer', 'Formaat' => 'Compact, voor in de meterkast'],
                'related' => ['4k-ip-camera-buiten', 'dome-camera-binnen', 'netwerkkabel-cat6-50-m', 'nvr-recorder-16-kanalen'],
            ],
            'nvr-recorder-16-kanalen' => [
                'text' => 'Recorder voor maximaal 16 camera\'s, voor grotere panden en bedrijven.',
                'heading' => 'Voor grotere panden',
                'description' => 'Heeft u veel camera\'s, bijvoorbeeld rond een bedrijfspand? Deze recorder heeft ruimte voor 16 camera\'s en meer opslag.',
                'features' => ['Voor maximaal 16 camera\'s', 'Extra opslag', 'Beelden terugkijken via de app'],
                'specs' => ['Kanalen' => '16', 'Opslag' => 'Harde schijf 4 TB', 'Aansluiting camera\'s' => '16 × PoE', 'Beeld bekijken' => 'App en computer', 'Formaat' => 'Voor een serverkast'],
                'related' => ['4k-ip-camera-buiten', 'dome-camera-binnen', 'netwerkkabel-cat6-50-m', 'nvr-recorder-8-kanalen'],
            ],
            'draadloze-alarmset' => [
                'text' => 'Complete alarmset met centrale, sensoren en sirene. Draadloos, dus snel geplaatst.',
                'heading' => 'Direct een melding bij inbraak',
                'description' => 'De set bestaat uit een centrale, bewegingsmelders, deur- en raamcontacten en een sirene. U zet het alarm aan en uit met de app of een afstandsbediening.',
                'features' => ['Draadloze sensoren', 'Melding op uw telefoon', 'Aan- en uitzetten met de app'],
                'specs' => ['Inhoud' => 'Centrale, 2 bewegingsmelders, 2 deurcontacten, sirene', 'Verbinding' => 'Draadloos', 'Bediening' => 'App en afstandsbediening', 'Uitbreidbaar' => 'Ja, met extra sensoren', 'Voeding' => 'Netstroom met noodaccu'],
                'related' => ['bewegingsmelder', '4k-ip-camera-buiten', 'codeklavier-met-taglezer', 'video-deurbel-met-monitor'],
            ],
            'bewegingsmelder' => [
                'text' => 'Extra draadloze bewegingsmelder om uw alarmsysteem uit te breiden.',
                'heading' => 'Breid uw alarm uit',
                'description' => 'Met een extra bewegingsmelder beveiligt u nog een ruimte. Hij verbindt draadloos met de centrale van uw alarmsysteem.',
                'features' => ['Draadloos', 'Huisdiervriendelijk', 'Lange batterijduur'],
                'specs' => ['Bereik' => 'Tot 12 meter', 'Verbinding' => 'Draadloos', 'Batterij' => 'Tot 3 jaar', 'Montage' => 'Muur of hoek', 'Geschikt voor' => 'Draadloze alarmset'],
                'related' => ['draadloze-alarmset', '4k-ip-camera-buiten', 'codeklavier-met-taglezer', 'dome-camera-binnen'],
            ],
            'codeklavier-met-taglezer' => [
                'text' => 'Toegang met een code of een tag. Voor de voordeur, het kantoor of de bedrijfsruimte.',
                'heading' => 'Geen sleutels meer nodig',
                'description' => 'Met het codeklavier opent u de deur met een pincode of een tag. Raakt iemand een tag kwijt? Dan zet u die tag gewoon uit.',
                'features' => ['Openen met code of tag', 'Tags eenvoudig uitzetten', 'Geschikt voor buiten'],
                'specs' => ['Openen met' => 'Pincode of tag', 'Aantal gebruikers' => 'Tot 1000', 'Behuizing' => 'IP65, geschikt voor buiten', 'Aansluiting' => 'Elektrisch slot', 'Voeding' => '12 V'],
                'related' => ['video-deurbel-met-monitor', 'draadloze-alarmset', '4k-ip-camera-buiten', 'netwerkkabel-cat6-50-m'],
            ],
            'video-deurbel-met-monitor' => [
                'text' => 'Zie wie er voor de deur staat, ook als u niet thuis bent. Met monitor binnen en app.',
                'heading' => 'Weet wie er aanbelt',
                'description' => 'De video-deurbel toont de bezoeker op de monitor in huis en op uw telefoon. U praat met de bezoeker en opent zo nodig de deur.',
                'features' => ['Beeld en geluid', 'Melding op uw telefoon', 'Deur openen op afstand'],
                'specs' => ['Camera' => 'Full HD', 'Monitor' => '7 inch', 'Bediening' => 'Monitor en app', 'Behuizing' => 'Geschikt voor buiten', 'Aansluiting' => 'Bekabeld'],
                'related' => ['codeklavier-met-taglezer', '4k-ip-camera-buiten', 'draadloze-alarmset', 'netwerkkabel-cat6-50-m'],
            ],
            'netwerkkabel-cat6-50-m' => [
                'text' => 'Netwerkkabel voor buiten en binnen. Geeft camera\'s beeld én stroom via één kabel (PoE).',
                'heading' => 'Eén kabel voor beeld en stroom',
                'description' => 'Met deze kabel sluit u camera\'s aan op de recorder. Via dezelfde kabel krijgt de camera ook stroom, dus u heeft geen stopcontact nodig.',
                'features' => ['Geschikt voor PoE', 'Voor binnen en buiten', '50 meter op een rol'],
                'specs' => ['Type' => 'CAT6', 'Lengte' => '50 meter', 'Geschikt voor' => 'Binnen en buiten', 'Aders' => 'Koper', 'Stekkers' => 'Los meegeleverd'],
                'related' => ['4k-ip-camera-buiten', 'nvr-recorder-8-kanalen', 'dome-camera-binnen', 'bewegingsmelder'],
            ],
        ];

        return $details[$slug] ?? ['text' => '', 'heading' => '', 'description' => '', 'features' => [], 'specs' => [], 'related' => []];
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
