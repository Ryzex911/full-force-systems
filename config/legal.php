<?php

/*
|--------------------------------------------------------------------------
| Full Force Systems - Juridische informatie
|--------------------------------------------------------------------------
|
| Deze teksten zijn concepten voor het schoolproject.
| De opdrachtgever moet de gegevens en voorwaarden controleren.
|
*/

$company = [
    'name' => 'Full Force Systems',

    // Vul de geregistreerde bedrijfsnaam in.
    'legal_name' => null,

    // Officiële contactgegevens.
    'email' => null,
    'phone' => null,

    // Vestigingsadres.
    'address' => null,
    'postal_code' => null,
    'city' => null,

    // Registratiegegevens.
    'kvk' => null,
    'vat' => null,

    // Retouradres.
    'return_address' => null,

    // Verzending.
    'shipping_area' => null,
    'delivery_time' => null,
    'shipping_costs' => null,
    'return_costs' => null,
];

$name = $company['name'];

return [

    /*
    |--------------------------------------------------------------------------
    | Publicatiestatus
    |--------------------------------------------------------------------------
    |
    | Zet pas op true nadat de opdrachtgever alles heeft gecontroleerd.
    |
    */

    'approved' => false,

    'updated_at' => '15 oktober 2026',

    'company' => $company,

    /*
    |--------------------------------------------------------------------------
    | Juridische pagina's
    |--------------------------------------------------------------------------
    */

    'pages' => [

        'privacy' => [

            'title' => 'Privacyverklaring',

            'subtitle' => 'Hoe wij omgaan met persoonsgegevens.',

            'intro' =>
                "$name vindt het belangrijk dat persoonsgegevens zorgvuldig
                worden behandeld. In deze privacyverklaring leggen wij uit
                welke gegevens verwerkt kunnen worden, waarom dit gebeurt
                en welke rechten bezoekers en klanten hebben.",

            'sections' => [

                [
                    'title' => '1. Wie is verantwoordelijk?',
                    'paragraphs' => [
                        "$name is de handelsnaam van de organisatie die
                        verantwoordelijk is voor de verwerking van
                        persoonsgegevens. De volledige juridische identiteit
                        en contactgegevens staan onderaan deze pagina."
                    ],
                ],

                [
                    'title' => '2. Welke gegevens verwerken wij?',
                    'paragraphs' => [
                        'Afhankelijk van de functies die de bezoeker gebruikt,
                        kunnen wij de volgende persoonsgegevens verwerken.'
                    ],
                    'bullets' => [
                        'Naam en contactgegevens.',
                        'E-mailadres.',
                        'Telefoonnummer wanneer dit wordt opgegeven.',
                        'Bedrijfsnaam bij zakelijke accounts.',
                        'Accountgegevens.',
                        'Offerteaanvragen en contactberichten.',
                        'Bestel- en betaalgegevens wanneer de webshop actief is.',
                        'Technische gegevens die nodig zijn voor de beveiliging van de website.',
                    ],
                ],

                [
                    'title' => '3. Waarom verwerken wij gegevens?',
                    'paragraphs' => [
                        'Wij gebruiken persoonsgegevens alleen wanneer
                        daarvoor een geldige wettelijke grondslag bestaat.'
                    ],
                    'bullets' => [
                        'Uitvoering van een overeenkomst, bijvoorbeeld het verwerken van een bestelling.',
                        'Beantwoorden van contact- en offerteaanvragen.',
                        'Beheren en beveiligen van gebruikersaccounts.',
                        'Nakomen van wettelijke verplichtingen, zoals administratieve verplichtingen.',
                        'Beschermen van de website tegen misbruik, voor zover daarvoor een gerechtvaardigd belang bestaat.',
                        'Verwerkingen waarvoor de bezoeker toestemming heeft gegeven.',
                    ],
                ],

                [
                    'title' => '4. Delen met andere partijen',
                    'paragraphs' => [
                        'Voor bepaalde functies kunnen externe dienstverleners
                        nodig zijn. Denk aan hosting, betalingsverwerking,
                        e-mailverzending en bezorgdiensten.',
                        'Welke partijen daadwerkelijk gegevens ontvangen,
                        moet worden gecontroleerd voordat de website live gaat.',
                        'Persoonsgegevens worden niet zonder geldige grondslag
                        met andere partijen gedeeld.'
                    ],
                ],

                [
                    'title' => '5. Hoe lang bewaren wij gegevens?',
                    'paragraphs' => [
                        'Persoonsgegevens worden niet langer bewaard dan
                        noodzakelijk is voor het doel waarvoor ze zijn verzameld.',
                        'Voor bepaalde administratieve gegevens kunnen wettelijke
                        bewaartermijnen gelden.',
                        'De specifieke bewaartermijnen per gegevenscategorie
                        worden vastgesteld voordat de website in productie gaat.'
                    ],
                ],

                [
                    'title' => '6. Beveiliging',
                    'paragraphs' => [
                        'Wij treffen passende technische en organisatorische
                        maatregelen om persoonsgegevens te beschermen.',
                        'Voorbeelden zijn versleutelde verbindingen,
                        toegangsbeperkingen en het veilig opslaan van
                        wachtwoorden.',
                        'De daadwerkelijke beveiligingsmaatregelen worden
                        regelmatig gecontroleerd.'
                    ],
                ],

                [
                    'title' => '7. Rechten van gebruikers',
                    'paragraphs' => [
                        'Gebruikers hebben onder de AVG verschillende
                        privacyrechten. Deze kunnen afhankelijk van de situatie
                        worden uitgeoefend.'
                    ],
                    'bullets' => [
                        'Recht op inzage.',
                        'Recht op correctie.',
                        'Recht op verwijdering.',
                        'Recht op beperking van verwerking.',
                        'Recht op overdraagbaarheid van gegevens.',
                        'Recht om bezwaar te maken.',
                        'Recht om toestemming in te trekken.',
                    ],
                ],

                [
                    'title' => '8. Klachten over privacy',
                    'paragraphs' => [
                        'Bij vragen over persoonsgegevens kan contact worden
                        opgenomen via de contactgegevens van de organisatie.',
                        'Gebruikers kunnen daarnaast een klacht indienen
                        bij de Autoriteit Persoonsgegevens.'
                    ],
                ],

                [
                    'title' => '9. Doorgifte buiten Europa',
                    'paragraphs' => [
                        'Wanneer een externe dienstverlener persoonsgegevens
                        buiten de Europese Economische Ruimte verwerkt,
                        moet worden gecontroleerd welke wettelijke waarborgen
                        hiervoor gelden.',
                        'De gebruikte dienstverleners en eventuele
                        internationale doorgiften moeten vóór publicatie
                        worden vastgelegd.'
                    ],
                ],

                [
                    'title' => '10. Wijzigingen',
                    'paragraphs' => [
                        'Deze privacyverklaring kan worden aangepast wanneer
                        onze dienstverlening, website of wetgeving verandert.'
                    ],
                ],
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Algemene voorwaarden
        |--------------------------------------------------------------------------
        */

        'terms' => [

            'title' => 'Algemene voorwaarden',

            'subtitle' => 'Afspraken over onze producten en diensten.',

            'intro' =>
                "Deze algemene voorwaarden beschrijven de belangrijkste
                afspraken tussen $name en klanten. Voor zakelijke en
                particuliere klanten kunnen verschillende wettelijke regels
                gelden.",

            'sections' => [

                [
                    'title' => '1. Toepasselijkheid',
                    'paragraphs' => [
                        'Deze voorwaarden zijn bedoeld voor offertes,
                        overeenkomsten, producten en diensten van de organisatie.',
                        'De voorwaarden moeten vóór het sluiten van een
                        overeenkomst beschikbaar worden gesteld.',
                        'Dwingende wettelijke consumentenrechten blijven
                        altijd van toepassing.'
                    ],
                ],

                [
                    'title' => '2. Producten en diensten',
                    'paragraphs' => [
                        "$name richt zich op producten en diensten op het
                        gebied van beveiliging.",
                        'De precieze eigenschappen, mogelijkheden en eventuele
                        beperkingen worden bij het product, de dienst of
                        de offerte vermeld.'
                    ],
                ],

                [
                    'title' => '3. Offertes',
                    'paragraphs' => [
                        'Een offerte beschrijft welke producten of diensten
                        worden aangeboden en onder welke voorwaarden.',
                        'De geldigheidsduur, prijs en eventuele aanvullende
                        afspraken moeten duidelijk in de offerte staan.'
                    ],
                ],

                [
                    'title' => '4. Prijzen en betalingen',
                    'paragraphs' => [
                        'Voor het afronden van een bestelling moet duidelijk
                        zijn wat de totale prijs is.',
                        'Eventuele verzendkosten, belastingen en andere
                        verplichte kosten worden vooraf vermeld.',
                        'Beschikbare betaalmethoden worden tijdens het
                        bestelproces weergegeven.'
                    ],
                ],

                [
                    'title' => '5. Levering',
                    'paragraphs' => [
                        'Bij een bestelling wordt de verwachte levering
                        duidelijk aangegeven.',
                        'Wanneer geen andere leveringstermijn is afgesproken,
                        gelden de wettelijke regels voor levering.',
                        'Meer informatie staat op de pagina Verzendbeleid.'
                    ],
                ],

                [
                    'title' => '6. Herroepingsrecht',
                    'paragraphs' => [
                        'Consumenten hebben bij veel online aankopen
                        een wettelijke bedenktijd van 14 dagen.',
                        'Er bestaan wettelijke uitzonderingen, bijvoorbeeld
                        voor bepaalde op maat gemaakte producten.',
                        'Meer informatie staat op de pagina Retourbeleid.'
                    ],
                ],

                [
                    'title' => '7. Garantie',
                    'paragraphs' => [
                        'Geleverde producten moeten voldoen aan wat
                        de consument redelijkerwijs mag verwachten.',
                        'Wettelijke garantierechten blijven van toepassing.',
                        'Eventuele aanvullende commerciële garanties
                        worden afzonderlijk vermeld.'
                    ],
                ],

                [
                    'title' => '8. Aansprakelijkheid',
                    'paragraphs' => [
                        'De wettelijke regels over aansprakelijkheid
                        blijven van toepassing.',
                        'Deze voorwaarden beperken geen consumentenrechten
                        die volgens de wet niet mogen worden uitgesloten.'
                    ],
                ],

                [
                    'title' => '9. Klachten',
                    'paragraphs' => [
                        'Klachten kunnen worden ingediend via de
                        contactgegevens van de organisatie.',
                        'Wij vragen klanten om het probleem zo duidelijk
                        mogelijk te omschrijven.'
                    ],
                ],

                [
                    'title' => '10. Toepasselijk recht',
                    'paragraphs' => [
                        'Op overeenkomsten is in beginsel Nederlands recht
                        van toepassing, met behoud van toepasselijke
                        dwingende consumentenbescherming.'
                    ],
                ],
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Cookiebeleid
        |--------------------------------------------------------------------------
        */

        'cookies' => [

            'title' => 'Cookiebeleid',

            'subtitle' => 'Informatie over cookies en privacy.',

            'intro' =>
                "Op de website van $name kunnen cookies worden gebruikt.
                Cookies zijn kleine bestanden waarmee een website
                informatie kan onthouden.",

            'sections' => [

                [
                    'title' => '1. Wat zijn cookies?',
                    'paragraphs' => [
                        'Cookies zijn kleine tekstbestanden die door
                        websites op apparaten kunnen worden opgeslagen.',
                        'Sommige cookies zijn nodig om een website
                        goed te laten functioneren.'
                    ],
                ],

                [
                    'title' => '2. Functionele cookies',
                    'paragraphs' => [
                        'Laravel gebruikt bij ingeschakelde sessies
                        doorgaans cookies voor sessiebeheer en beveiliging.',
                        'Deze cookies helpen bijvoorbeeld bij het
                        herkennen van een ingelogde sessie en het
                        beveiligen van formulieren.'
                    ],
                ],

                [
                    'title' => '3. Analytische cookies',
                    'paragraphs' => [
                        'Analytische cookies kunnen worden gebruikt
                        om inzicht te krijgen in het gebruik van een website.',
                        'Of deze cookies daadwerkelijk worden geplaatst,
                        en welke toestemming daarvoor nodig is,
                        moet worden vastgesteld aan de hand van de
                        gekozen analyticssoftware.'
                    ],
                ],

                [
                    'title' => '4. Marketingcookies',
                    'paragraphs' => [
                        'Marketingcookies kunnen worden gebruikt om
                        bezoekers over websites heen te volgen.',
                        'Voor trackingcookies is voorafgaande toestemming
                        nodig. Deze mogen niet worden geplaatst voordat
                        geldige toestemming is verkregen.'
                    ],
                ],

                [
                    'title' => '5. Cookies beheren',
                    'paragraphs' => [
                        'Bezoekers kunnen cookies verwijderen
                        via hun browserinstellingen.',
                        'Wanneer optionele cookies worden gebruikt,
                        moet de website een mogelijkheid bieden om
                        toestemming te geven, te weigeren en in te trekken.'
                    ],
                ],

                [
                    'title' => '6. Overzicht van cookies',
                    'paragraphs' => [
                        'Voor publicatie moet een actueel overzicht worden
                        toegevoegd met de namen, aanbieders, doeleinden
                        en bewaartermijnen van daadwerkelijk gebruikte cookies.',
                        'Voorbeelden van mogelijke Laravel-cookies zijn
                        laravel_session en XSRF-TOKEN. Controleer of deze
                        daadwerkelijk op jullie website voorkomen.'
                    ],
                ],
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Retourbeleid
        |--------------------------------------------------------------------------
        */

        'returns' => [

            'title' => 'Retourbeleid',

            'subtitle' => 'Informatie over retourneren en herroepen.',

            'intro' =>
                'Wij vinden het belangrijk dat klanten vooraf begrijpen
                welke mogelijkheden zij hebben om een bestelling te
                annuleren of terug te sturen.',

            'sections' => [

                [
                    'title' => '1. Bedenktijd',
                    'paragraphs' => [
                        'Consumenten hebben bij de meeste online aankopen
                        recht op een bedenktijd van 14 dagen.',
                        'Bij producten begint deze termijn meestal op
                        de dag nadat het product is ontvangen.'
                    ],
                ],

                [
                    'title' => '2. Herroepen',
                    'paragraphs' => [
                        'Een consument kan binnen de wettelijke termijn
                        laten weten de overeenkomst te willen herroepen.',
                        'Dit kan met een duidelijke verklaring aan de verkoper.',
                        'Wanneer online verkopen worden geactiveerd,
                        moet ook een geschikte online herroepingsfunctie
                        beschikbaar zijn.'
                    ],
                ],

                [
                    'title' => '3. Product terugsturen',
                    'paragraphs' => [
                        'Na het melden van de herroeping heeft de consument
                        in beginsel nog 14 dagen om het product terug te sturen.',
                        'Het definitieve retouradres wordt vóór de start
                        van de webshop op deze pagina gepubliceerd.'
                    ],
                ],

                [
                    'title' => '4. Retourkosten',
                    'paragraphs' => [
                        'De verkoper moet vóór de aankoop duidelijk aangeven
                        wie de directe retourkosten betaalt.',
                        'Wanneer consumenten hierover niet correct
                        zijn geïnformeerd, kunnen deze kosten voor
                        rekening van de verkoper komen.',
                        'De definitieve retourkosten worden vastgesteld
                        door de opdrachtgever.'
                    ],
                ],

                [
                    'title' => '5. Terugbetaling',
                    'paragraphs' => [
                        'Na een geldige herroeping wordt het verschuldigde
                        bedrag volgens de wettelijke regels terugbetaald.',
                        'De terugbetaling moet in beginsel binnen
                        14 dagen na de herroepingsmelding plaatsvinden.',
                        'Bij goederen mag de verkoper onder voorwaarden
                        wachten totdat deze zijn ontvangen of totdat
                        verzending is aangetoond.',
                        'Bij volledige herroeping worden ook de kosten
                        van de standaardlevering terugbetaald.'
                    ],
                ],

                [
                    'title' => '6. Uitzonderingen',
                    'paragraphs' => [
                        'Voor sommige producten en diensten gelden
                        wettelijke uitzonderingen op het herroepingsrecht.',
                        'Dat kan bijvoorbeeld gelden voor producten die
                        volgens specificaties van de consument zijn gemaakt.',
                        'Bij bepaalde volledig uitgevoerde diensten
                        kan het herroepingsrecht onder wettelijke
                        voorwaarden vervallen.',
                        'Een uitzondering wordt alleen toegepast
                        wanneer aan alle wettelijke voorwaarden is voldaan.'
                    ],
                ],

                [
                    'title' => '7. Beschadigde producten',
                    'paragraphs' => [
                        'Wanneer een product beschadigd wordt geleverd
                        of niet aan de overeenkomst voldoet, blijven
                        de wettelijke rechten van de consument bestaan.'
                    ],
                ],
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Verzendbeleid
        |--------------------------------------------------------------------------
        */

        'shipping' => [

            'title' => 'Verzendbeleid',

            'subtitle' => 'Informatie over verzending en levering.',

            'intro' =>
                'Op deze pagina staat hoe bestellingen worden verwerkt
                en welke afspraken gelden voor levering.',

            'sections' => [

                [
                    'title' => '1. Verzendgebieden',
                    'paragraphs' => [
                        'De landen en regio’s waarin bestellingen
                        geleverd kunnen worden, moeten vooraf
                        duidelijk worden aangegeven.',
                        'De definitieve verzendgebieden worden
                        door de opdrachtgever vastgesteld.'
                    ],
                ],

                [
                    'title' => '2. Verzendkosten',
                    'paragraphs' => [
                        'Eventuele verzendkosten worden vóór het
                        afronden van een bestelling bekendgemaakt.',
                        'Klanten moeten de totale kosten kunnen
                        zien voordat zij betalen.'
                    ],
                ],

                [
                    'title' => '3. Levertijden',
                    'paragraphs' => [
                        'Bij producten wordt de verwachte levertijd
                        vermeld.',
                        'Wanneer geen andere termijn is afgesproken,
                        moet in beginsel binnen 30 dagen worden geleverd.',
                        'Als levering niet op tijd plaatsvindt,
                        gelden de wettelijke rechten van de consument.'
                    ],
                ],

                [
                    'title' => '4. Beschadiging en verlies',
                    'paragraphs' => [
                        'Bij consumentenkoop draagt de verkoper
                        in beginsel het risico van verzending
                        totdat de consument het product ontvangt.',
                        'Bij beschadiging of verlies kan de klant
                        contact opnemen met de verkoper.'
                    ],
                ],

                [
                    'title' => '5. Installatie en montage',
                    'paragraphs' => [
                        'Voor producten waarvoor installatie of
                        montage nodig is, worden eventuele
                        aanvullende afspraken vooraf vastgelegd.',
                        'De kosten en planning van deze diensten
                        moeten duidelijk zijn voordat de klant
                        de overeenkomst sluit.'
                    ],
                ],
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Garantie
        |--------------------------------------------------------------------------
        */

        'warranty' => [

            'title' => 'Garantie',

            'subtitle' => 'Informatie over wettelijke garantie.',

            'intro' =>
                'Klanten mogen verwachten dat een product
                voldoet aan wat is afgesproken en aan wat
                zij redelijkerwijs van het product mogen verwachten.',

            'sections' => [

                [
                    'title' => '1. Wettelijke garantie',
                    'paragraphs' => [
                        'In Nederland geldt wettelijke garantie
                        voor consumenten.',
                        'Er bestaat geen algemene vaste wettelijke
                        garantietermijn van twee jaar voor alle
                        producten in Nederland.',
                        'Hoelang een product mee moet gaan,
                        hangt onder andere af van het soort
                        product en wat de consument mocht verwachten.'
                    ],
                ],

                [
                    'title' => '2. Defect product',
                    'paragraphs' => [
                        'Wanneer een product niet aan de overeenkomst
                        voldoet, kan de consument recht hebben
                        op kosteloos herstel of vervanging.',
                        'Afhankelijk van de situatie kunnen ook
                        andere wettelijke oplossingen mogelijk zijn.'
                    ],
                ],

                [
                    'title' => '3. Fabrieksgarantie',
                    'paragraphs' => [
                        'Sommige fabrikanten bieden aanvullende
                        commerciële garantie.',
                        'De voorwaarden daarvan worden bij het
                        betreffende product vermeld.',
                        'Fabrieksgarantie vervangt de wettelijke
                        garantierechten niet.'
                    ],
                ],

                [
                    'title' => '4. Garantie aanvragen',
                    'paragraphs' => [
                        'Klanten kunnen een probleem melden
                        via de contactgegevens van de organisatie.',
                        'Vermeld bij voorkeur het ordernummer,
                        het product en een duidelijke omschrijving
                        van het probleem.'
                    ],
                ],

                [
                    'title' => '5. Zakelijke klanten',
                    'paragraphs' => [
                        'Voor zakelijke overeenkomsten kunnen
                        andere afspraken gelden.',
                        'Deze afspraken moeten vooraf duidelijk
                        worden vastgelegd.'
                    ],
                ],
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Klachtenprocedure
        |--------------------------------------------------------------------------
        */

        'complaints' => [

            'title' => 'Klachtenprocedure',

            'subtitle' => 'Wij helpen klanten bij vragen en klachten.',

            'intro' =>
                'Heb je een klacht over een product, dienst,
                bestelling of onze dienstverlening?
                Dan kun je contact met ons opnemen.',

            'sections' => [

                [
                    'title' => '1. Een klacht indienen',
                    'paragraphs' => [
                        'Een klacht kan worden ingediend via
                        de officiële contactgegevens van
                        de organisatie.'
                    ],
                    'bullets' => [
                        'Vermeld je naam.',
                        'Vermeld je e-mailadres.',
                        'Beschrijf het probleem.',
                        'Vermeld indien mogelijk je ordernummer.',
                        'Voeg eventueel foto’s of andere relevante informatie toe.',
                    ],
                ],

                [
                    'title' => '2. Behandeling',
                    'paragraphs' => [
                        'Na ontvangst wordt de klacht beoordeeld.',
                        'Wanneer aanvullende informatie nodig is,
                        kan hierover contact worden opgenomen.',
                        'De organisatie probeert klachten
                        binnen een redelijke termijn op te lossen.'
                    ],
                ],

                [
                    'title' => '3. Mogelijke oplossingen',
                    'paragraphs' => [
                        'De passende oplossing hangt af van
                        de aard van de klacht en de wettelijke
                        rechten van de klant.'
                    ],
                    'bullets' => [
                        'Uitleg of aanvullende ondersteuning.',
                        'Herstel van een product.',
                        'Vervanging van een product.',
                        'Een passende andere wettelijke oplossing.',
                    ],
                ],

                [
                    'title' => '4. Niet tevreden?',
                    'paragraphs' => [
                        'Wanneer een klacht niet naar tevredenheid
                        wordt opgelost, kan de consument bekijken
                        welke mogelijkheden voor verdere
                        geschilbeslechting beschikbaar zijn.',
                        'Een eventuele aansluiting bij een
                        geschillencommissie moet door de
                        opdrachtgever worden bevestigd.'
                    ],
                ],
            ],
        ],
    ],
];
