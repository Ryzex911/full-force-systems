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
        ['label' => 'Diensten', 'route' => 'diensten', 'anchor' => null],
        ['label' => 'Pakketten', 'route' => 'pakketten', 'anchor' => null],
        ['label' => 'Webshop', 'route' => null, 'anchor' => 'webshop'],
        ['label' => 'Projecten', 'route' => null, 'anchor' => 'projecten'],
        ['label' => 'Over ons', 'route' => 'over-ons', 'anchor' => null],
        ['label' => 'Contact', 'route' => 'contact', 'anchor' => null],
    ],

    /*
    | Partners die genoemd mogen worden (wensenformulier, vraag 6).
    | De homepage toont de eerste zes, de pagina Over ons toont ze allemaal.
    */
    'partners' => [
        'Full Force Security',
        'PNBS Security',
        'Parabellen',
        'Resecure',
        'EMB Security',
        'TaskTime',
        'Card Multiverse',
        'The Rolling Office',
        'Safety First Academy',
        'Makay Security',
        'Flex Force Direct',
    ],

    /*
    | De vijf diensten. Ze staan op de homepage (de eerste twee uitgelicht) en op de pagina Diensten.
    | 'slug' is het anker op de dienstenpagina (/diensten#camerabewaking) en later het adres van de detailpagina.
    | 'image' is een pad binnen public/ of null; zonder foto tonen we het icoon van de dienst.
    | Foto's in public/images/voorbeeld/ zijn tijdelijk (Unsplash) tot de opdrachtgever eigen foto's levert.
    */
    'services' => [
        [
            'slug' => 'camerabewaking',
            'icon' => 'camera',
            'title' => 'Camerabewaking',
            'text' => 'Scherp beeld van uw woning of bedrijfspand, dag en nacht. Wij adviseren, installeren en leggen uit hoe u meekijkt.',
            'points' => ['Advies op locatie', 'Montage en afstelling', 'Uitleg bij oplevering'],
            'image' => 'images/voorbeeld/camera.jpg',
        ],
        [
            'slug' => 'alarmsystemen',
            'icon' => 'alarm',
            'title' => 'Alarmsystemen',
            'text' => 'Een alarmsysteem dat past bij uw situatie, met sensoren op de juiste plekken en een bediening die iedereen begrijpt.',
            'points' => ['Bedraad of draadloos', "Uit te breiden met camera's", 'Onderhoud mogelijk'],
            'image' => null,
        ],
        [
            'slug' => 'toegangscontrole',
            'icon' => 'lock',
            'title' => 'Toegangscontrole',
            'text' => 'Bepaal wie wanneer naar binnen mag, met tags, codes of uw telefoon.',
            'points' => ['Tags, codes of telefoon', 'Rechten per persoon of tijdstip', 'Te combineren met intercom'],
            'image' => null,
        ],
        [
            'slug' => 'video-intercom',
            'icon' => 'intercom',
            'title' => 'Video-intercom',
            'text' => 'Zie en spreek uw bezoek voordat u de deur opent.',
            'points' => ['Beeld en geluid bij de deur', 'Te koppelen aan toegangscontrole', 'Voor één of meerdere deuren'],
            'image' => null,
        ],
        [
            'slug' => 'onderhoud-service',
            'icon' => 'wrench',
            'title' => 'Onderhoud & service',
            'text' => 'Periodieke controle en snelle hulp bij storingen, zodat uw systeem blijft werken.',
            'points' => ['Periodieke controle', 'Hulp bij storingen', 'Uitbreiding en aanpassing'],
            'image' => null,
        ],
    ],

    /*
    | Werkwijze uit het wensenformulier: voorstel, akkoord, afspraak, installatie.
    | Wordt getoond met @include('partials.werkwijze').
    */
    'steps' => [
        ['title' => 'Voorstel', 'text' => 'U vertelt wat u wilt beveiligen. Wij adviseren en sturen een duidelijk voorstel met prijs.'],
        ['title' => 'Akkoord', 'text' => 'Past het voorstel? Dan bevestigt u en leggen we alles vast.'],
        ['title' => 'Afspraak', 'text' => 'We plannen de installatie op een moment dat u uitkomt.'],
        ['title' => 'Installatie', 'text' => 'Wij monteren, stellen af en leggen uit hoe alles werkt.'],
    ],

];
