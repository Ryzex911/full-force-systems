<?php

/*
|--------------------------------------------------------------------------
| Vaste gegevens van Full Force Systems
|--------------------------------------------------------------------------
|
| Bedrijfsgegevens, navigatie en diensten die op meerdere pagina's terugkomen.
| De gegevens komen uit het wensenformulier van de opdrachtgever (23-09-2026).
| Gebruik in Blade: {{ config('site.phone') }}
|
*/

return [

    'name' => 'Full Force Systems',
    'legal_name' => 'Full Force Security BV',

    'phone' => '0487-845422',
    'phone_href' => 'tel:+31487845422',
    'email' => 'info@fullforcesystems.nl',

    'address' => [
        'street' => 'Roggeweg 30K',
        'postcode' => '6534 AJ',
        'city' => 'Nijmegen',
    ],

    'hours' => 'Werkdagen 10:00 – 17:00',
    'regions' => ['Gelderland', 'Brabant', 'Limburg'],

    'payment_methods' => ['iDEAL', 'Bankoverschrijving'],

    /*
    | Hoofdnavigatie. 'route' is de naam van de route in routes/web.php.
    | Zolang een pagina nog niet bestaat (route null), springt de link naar het blok
    | 'anchor' op de homepage. Zonder route en zonder anchor wordt de link '#'.
    | De link zelf wordt gemaakt in app/Support/Nav.php.
    */
    'nav' => [
        ['label' => 'Home', 'route' => 'home', 'anchor' => null],
        ['label' => 'Diensten', 'route' => null, 'anchor' => 'diensten'],
        ['label' => 'Pakketten', 'route' => null, 'anchor' => 'pakketten'],
        ['label' => 'Webshop', 'route' => null, 'anchor' => 'webshop'],
        ['label' => 'Projecten', 'route' => null, 'anchor' => 'projecten'],
        ['label' => 'Over ons', 'route' => null, 'anchor' => null],
        ['label' => 'Contact', 'route' => null, 'anchor' => 'offerte'],
    ],

    /*
    | De vijf diensten. De eerste twee (camera en alarm) staan uitgelicht op de homepage
    | en hebben daarom ook 'points' (opsomming) en eventueel een 'image' (pad binnen public/).
    | Foto's in public/images/voorbeeld/ zijn tijdelijk (Unsplash) tot de opdrachtgever eigen foto's levert.
    */
    'services' => [
        [
            'icon' => 'camera',
            'title' => 'Camerabewaking',
            'text' => 'Scherp beeld van uw woning of bedrijfspand, dag en nacht. Wij adviseren, installeren en leggen uit hoe u meekijkt.',
            'points' => ['Advies op locatie', 'Montage en afstelling', 'Uitleg bij oplevering'],
            'image' => 'images/voorbeeld/camera.jpg',
        ],
        [
            'icon' => 'alarm',
            'title' => 'Alarmsystemen',
            'text' => 'Een alarmsysteem dat past bij uw situatie, met sensoren op de juiste plekken en een bediening die iedereen begrijpt.',
            'points' => ['Bedraad of draadloos', "Uit te breiden met camera's", 'Onderhoud mogelijk'],
            'image' => null,
        ],
        [
            'icon' => 'lock',
            'title' => 'Toegangscontrole',
            'text' => 'Bepaal wie wanneer naar binnen mag, met tags, codes of uw telefoon.',
        ],
        [
            'icon' => 'intercom',
            'title' => 'Video-intercom',
            'text' => 'Zie en spreek uw bezoek voordat u de deur opent.',
        ],
        [
            'icon' => 'wrench',
            'title' => 'Onderhoud & service',
            'text' => 'Periodieke controle en snelle hulp bij storingen, zodat uw systeem blijft werken.',
        ],
    ],

];
