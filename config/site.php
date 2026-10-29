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
        ['label' => 'Webshop', 'route' => 'webshop', 'anchor' => null],
        ['label' => 'Projecten', 'route' => 'projecten', 'anchor' => null],
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
    | De vijf diensten. Ze staan op de homepage (de eerste twee uitgelicht), op de pagina Diensten,
    | in de footer en elk op een eigen detailpagina (/diensten/{slug}, ontwerp: docs/ontwerp/03-dienst-detail.png).
    |
    | 'slug'       adres van de detailpagina, en het anker op de dienstenpagina (/diensten#camerabewaking)
    | 'text'       korte tekst voor kaarten en de dienstenpagina
    | 'points'     opsomming voor kaarten en de dienstenpagina
    | 'image'      pad binnen public/ of null; zonder foto tonen we het icoon van de dienst
    | 'intro'      lange tekst bovenaan de detailpagina
    | 'benefits'   "Wat u krijgt": drie kaarten met icoon, titel en tekst
    | 'price_note' kleine tekst achter "Vaste prijs" (particulier)
    | 'faq'        veelgestelde vragen; de antwoorden volgen nog van de opdrachtgever
    | 'products'   bijpassende producten (slugs uit App\Support\Catalog::products())
    | 'example'    true = de teksten van de detailpagina zijn VOORBEELD en moeten nog worden nagelezen door de opdrachtgever
    |
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
            // Teksten van de detailpagina uit het ontwerp (03 Dienst detail – Camerabewaking)
            'intro' => 'Scherp beeld van uw woning of bedrijfspand, dag en nacht. Wij kijken mee naar uw situatie, plaatsen de camera\'s op de juiste plekken en leggen uit hoe alles werkt.',
            'benefits' => [
                ['icon' => 'pin', 'title' => 'Advies op locatie', 'text' => 'We lopen samen door uw woning of pand en bepalen waar camera\'s het meeste zicht geven.'],
                ['icon' => 'wrench', 'title' => 'Montage en afstelling', 'text' => 'Nette montage, kabels weggewerkt waar het kan en elk beeld afgesteld op de juiste hoek.'],
                ['icon' => 'users', 'title' => 'Uitleg en nazorg', 'text' => 'U krijgt uitleg over bediening en terugkijken. Loopt u ergens tegenaan, dan helpen we verder.'],
            ],
            'price_note' => 'vanaf pakket Basis',
            'faq' => [
                'Kan ik de beelden op mijn telefoon bekijken?',
                'Hoe lang duurt de installatie?',
                'Kan ik het systeem later uitbreiden?',
                'Hoe zit het met privacy en de buren?',
            ],
            'products' => ['4k-ip-camera-buiten', 'dome-camera-binnen', 'nvr-recorder-8-kanalen', 'netwerkkabel-cat6-50-m'],
            'example' => false,
        ],
        [
            'slug' => 'alarmsystemen',
            'icon' => 'alarm',
            'title' => 'Alarmsystemen',
            'text' => 'Een alarmsysteem dat past bij uw situatie, met sensoren op de juiste plekken en een bediening die iedereen begrijpt.',
            'points' => ['Bedraad of draadloos', "Uit te breiden met camera's", 'Onderhoud mogelijk'],
            'image' => null,
            // VOORBEELD: geen ontwerp voor deze dienst; teksten nog laten nalezen door de opdrachtgever
            'intro' => 'Een alarmsysteem dat past bij uw woning of bedrijfspand. Wij bepalen samen waar de sensoren moeten komen, installeren alles netjes en leggen uit hoe u het systeem aan- en uitzet.',
            'benefits' => [
                ['icon' => 'pin', 'title' => 'Advies op locatie', 'text' => 'We lopen samen door uw pand en bepalen welke ruimtes en ingangen beveiligd moeten worden.'],
                ['icon' => 'wrench', 'title' => 'Installatie op maat', 'text' => 'Bedraad of draadloos, met sensoren op de juiste plekken en een bediening die iedereen begrijpt.'],
                ['icon' => 'users', 'title' => 'Uitleg en nazorg', 'text' => 'U krijgt uitleg over het in- en uitschakelen. Loopt u ergens tegenaan, dan helpen we verder.'],
            ],
            'price_note' => 'vanaf pakket Plus',
            'faq' => [
                'Kan ik het alarm met mijn telefoon bedienen?',
                'Wat gebeurt er als het alarm afgaat?',
                "Kan ik het alarm combineren met camera's?",
                'Is een draadloos alarm net zo betrouwbaar als een bedraad alarm?',
            ],
            'products' => ['draadloze-alarmset', 'bewegingsmelder', '4k-ip-camera-buiten', 'nvr-recorder-8-kanalen'],
            'example' => true,
        ],
        [
            'slug' => 'toegangscontrole',
            'icon' => 'lock',
            'title' => 'Toegangscontrole',
            'text' => 'Bepaal wie wanneer naar binnen mag, met tags, codes of uw telefoon.',
            'points' => ['Tags, codes of telefoon', 'Rechten per persoon of tijdstip', 'Te combineren met intercom'],
            'image' => null,
            // VOORBEELD: geen ontwerp voor deze dienst; teksten nog laten nalezen door de opdrachtgever
            'intro' => 'Bepaal zelf wie wanneer naar binnen mag. Met tags, codes of uw telefoon geeft u toegang, en u trekt die net zo makkelijk weer in.',
            'benefits' => [
                ['icon' => 'pin', 'title' => 'Advies op locatie', 'text' => 'We bekijken uw deuren en ingangen en adviseren welk systeem het beste bij uw pand past.'],
                ['icon' => 'lock', 'title' => 'Rechten per persoon', 'text' => 'Per persoon of tijdstip instellen wie waar naar binnen mag, en toegang direct weer intrekken.'],
                ['icon' => 'users', 'title' => 'Uitleg en nazorg', 'text' => 'U leert hoe u gebruikers toevoegt en verwijdert. Loopt u ergens tegenaan, dan helpen we verder.'],
            ],
            'price_note' => 'afhankelijk van het aantal deuren',
            'faq' => [
                'Wat gebeurt er als iemand zijn tag verliest?',
                'Kan ik toegang op afstand regelen?',
                'Werkt het systeem ook bij een stroomstoring?',
                'Kan ik toegangscontrole koppelen aan de intercom?',
            ],
            'products' => ['codeklavier-met-taglezer', 'video-deurbel-met-monitor', 'netwerkkabel-cat6-50-m'],
            'example' => true,
        ],
        [
            'slug' => 'video-intercom',
            'icon' => 'intercom',
            'title' => 'Video-intercom',
            'text' => 'Zie en spreek uw bezoek voordat u de deur opent.',
            'points' => ['Beeld en geluid bij de deur', 'Te koppelen aan toegangscontrole', 'Voor één of meerdere deuren'],
            'image' => null,
            // VOORBEELD: geen ontwerp voor deze dienst; teksten nog laten nalezen door de opdrachtgever
            'intro' => 'Zie en spreek uw bezoek voordat u de deur opent. Wij plaatsen de intercom bij de deur en het scherm binnen, en koppelen hem als u wilt aan uw toegangscontrole.',
            'benefits' => [
                ['icon' => 'pin', 'title' => 'Advies op locatie', 'text' => 'We kijken naar uw voordeur of ingang en adviseren welke intercom daar het beste werkt.'],
                ['icon' => 'wrench', 'title' => 'Montage en aansluiting', 'text' => 'Nette montage bij de deur en binnen, met de kabels weggewerkt waar het kan.'],
                ['icon' => 'users', 'title' => 'Uitleg en nazorg', 'text' => 'U krijgt uitleg over opnemen, spreken en opendoen. Loopt u ergens tegenaan, dan helpen we verder.'],
            ],
            'price_note' => 'vanaf pakket Compleet',
            'faq' => [
                'Kan ik de deur openen met mijn telefoon?',
                'Werkt de intercom ook voor meerdere deuren?',
                'Kan ik zien wie er is aangebeld terwijl ik weg was?',
                'Werkt de intercom samen met toegangscontrole?',
            ],
            'products' => ['video-deurbel-met-monitor', 'codeklavier-met-taglezer', 'netwerkkabel-cat6-50-m'],
            'example' => true,
        ],
        [
            'slug' => 'onderhoud-service',
            'icon' => 'wrench',
            'title' => 'Onderhoud & service',
            'text' => 'Periodieke controle en snelle hulp bij storingen, zodat uw systeem blijft werken.',
            'points' => ['Periodieke controle', 'Hulp bij storingen', 'Uitbreiding en aanpassing'],
            'image' => null,
            // VOORBEELD: geen ontwerp voor deze dienst; teksten nog laten nalezen door de opdrachtgever
            'intro' => 'Een beveiligingssysteem moet het doen op het moment dat het nodig is. Wij controleren uw systeem, helpen snel bij storingen en breiden het uit als uw situatie verandert.',
            'benefits' => [
                ['icon' => 'check', 'title' => 'Periodieke controle', 'text' => 'We controleren camera\'s, sensoren en opnames, zodat u zeker weet dat alles werkt.'],
                ['icon' => 'clock', 'title' => 'Hulp bij storingen', 'text' => 'Werkt er iets niet? Neem contact op, dan zoeken we samen snel een oplossing.'],
                ['icon' => 'wrench', 'title' => 'Uitbreiden en aanpassen', 'text' => 'Een extra camera of sensor nodig? Wij breiden uw systeem uit wanneer u dat wilt.'],
            ],
            'price_note' => 'afhankelijk van uw systeem',
            'faq' => [
                'Hoe vaak is onderhoud nodig?',
                'Doen jullie ook onderhoud aan een systeem dat een ander bedrijf heeft geplaatst?',
                'Hoe snel helpen jullie bij een storing?',
                'Kan ik mijn systeem later uitbreiden?',
            ],
            'products' => ['4k-ip-camera-buiten', 'nvr-recorder-16-kanalen', 'bewegingsmelder', 'netwerkkabel-cat6-50-m'],
            'example' => true,
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
