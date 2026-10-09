# Full Force Systems – projectcontext

Dit bestand geeft Claude de context van het project. Lees het voordat je iets wijzigt.
Antwoord in het Nederlands, in eenvoudige taal: het team bestaat uit twee mbo-4 studenten Software Developer.

## Wat is dit project

Nieuwe website met webshop en klantomgeving voor **Full Force Systems** (handelsnaam van Full Force Security BV, Nijmegen).
Het bedrijf verkoopt en installeert beveiligingstechniek: camerabewaking, alarmsystemen, toegangscontrole, video-intercom en onderhoud/service.

- **Team:** Tawfik Alabed (eigenaar van de repository `Ryzex911/full-force-systems`) en Tamzid Mehedi.
- **Opdrachtgever:** Nick Renssen (eigenaar). Hij heeft het team vrijheid gegeven om zelf met ideeën te komen.
- **Bron van de inhoud:** het ingevulde wensenformulier van 23-09-2026. Verzin geen bedrijfsgegevens; wat niet in het formulier staat is voorbeelddata.
- **Oude website:** fullforcesecurity.nl. Die gaat over beveiligers, niet over techniek; de diensten daarvan horen **niet** op de nieuwe site.
- **Niet verwarren:** "HitchTracker" (taxischerm, hackathon) is een losse schoolopdracht van Tawfik en hoort niet bij dit project.

## Waar we nu mee bezig zijn

**Alleen de front-end en opmaak.** Database, accounts, winkelmand, betalingen en adminpanel komen later.
Bouw pagina's dus met voorbeelddata in de controller, niet met modellen of migraties, tenzij daar expliciet om gevraagd wordt.

### Stand van zaken (09-10-2026)

- Ontwerp is klaar in Figma: 11 pagina's in donker en licht.
- Branch `feature/homepage` staat op GitHub en bevat: huisstijl, basislayout, componenten en de homepage.
- De homepage draait nu bij Tamzid in echt Laravel (PHP 8.4.26 in Laragon) en is nagelopen in donker en licht, op 1440 px en 390 px: geen horizontaal scrollen, geen kapotte afbeeldingen, geen JavaScript-fouten, lettertype Inter laadt, tests slagen.
- Hersteld bij die controle: `composer.json` vraagt nu PHP `^8.4` (gelijk aan `composer.lock`), `.env.example` heeft de naam Full Force Systems en taal `nl`, de mobiele menuknop toont een kruisje als het menu open is, en `color-scheme` volgt het thema.
- Homepage afgemaakt: foto's staan lokaal in `public/images/voorbeeld/` (de Unsplash-links laadden niet overal), menu-items springen naar het juiste blok op de homepage tot hun eigen pagina bestaat, de keuze particulier/zakelijk wisselt de hoofdknop in de hero, en "Offerte aanvragen" onderaan opent tijdelijk een e-mail.
- Wat op de homepage nog bewust niets doet (komt met latere pagina's of de database): "Meer informatie", "Alle projecten", "Naar de webshop", productkaarten, "In winkelwagen", zoeken, account, winkelwagen, "Over ons" en de juridische links.

### Volgende stappen, in deze volgorde

1. Overige pagina's bouwen volgens het Figma-ontwerp: Diensten, Dienst detail, Pakketten, Webshop, Productdetail, Projecten, Over ons, Contact en offerte, Inloggen/registreren, Mijn account.
2. Per nieuwe pagina: route met naam toevoegen in `routes/web.php` en die naam invullen bij `'route'` in `config/site.php` (`nav`), zodat het menu ernaar linkt.

## Techniek

- Laravel 13, PHP 8.4+ (verplicht: `symfony/clock` in `composer.lock` werkt niet op 8.3), MySQL (later), Blade
- Tailwind CSS 4 via Vite (`@tailwindcss/vite`), geen aparte `tailwind.config.js`
- Lettertype Inter via de fonts-optie van `laravel-vite-plugin` (zie `vite.config.js`) en `@fonts` in de layout
- Lokaal: Laragon op Windows, projectmap `C:\laragon\www\Project-Full Force` (let op de spatie: gebruik aanhalingstekens in `cd`)

### Starten

Zet eerst in Laragon PHP op 8.4 (rechtsklik op Laragon → PHP → Version) en open daarna een nieuwe terminal; `php -v` moet 8.4 tonen.
Lokaal gebruiken we SQLite: maak zo nodig het lege bestand `database/database.sqlite` aan vóór `php artisan migrate`. Zonder database crasht elke pagina, omdat de sessies in de database staan.

```
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run dev
```

En in een tweede terminal: `php artisan serve` → http://localhost:8000

## Opbouw van de code

| Wat | Waar |
|---|---|
| Kleuren (donker/licht), tekststijlen, `.wrap`, `.card`, `.icon-tile` | `resources/css/app.css` |
| Bedrijfsgegevens, menu, diensten | `config/site.php` → `config('site.phone')` |
| Voorbeelddata homepage | `app/Http/Controllers/HomeController.php` |
| Hoofdlayout | `resources/views/layouts/app.blade.php` |
| Header, footer, CTA-blok, keuze particulier/zakelijk | `resources/views/partials/` |
| Componenten: `x-button`, `x-icon`, `x-logo`, `x-section-heading`, `x-service-card`, `x-product-card`, `x-project-card`, `x-package-card` | `resources/views/components/` |
| Homepage, één bestand per sectie | `resources/views/pages/home.blade.php` en `pages/home/` |
| Themaknop, mobiel menu, particulier/zakelijk | `resources/js/app.js` |
| Link van een menu-item (route → blok op home → `#`) | `app/Support/Nav.php` |
| Tijdelijke foto's (Unsplash, lokaal opgeslagen) | `public/images/voorbeeld/` |
| Tests voor de homepage | `tests/Feature/HomePageTest.php` |

### Afspraken

- **Nieuwe pagina:** `@extends('layouts.app')`, inhoud in `@section('content')`, bestand in `resources/views/pages/`. Grote pagina's opsplitsen in secties in een eigen map, zoals bij home.
- **Hergebruik de componenten.** Maak geen tweede soort knop of kaart; breid de bestaande uit als er iets ontbreekt.
- **Kleuren alleen via de tokens**, nooit losse hex-codes in Blade: `bg-page`, `bg-alt`, `bg-surface`, `bg-surface-2`, `border-line`, `text-ink`, `text-ink-2`, `text-ink-3`, `bg-brand`, `text-brand-ink`, `bg-brand-soft`, `text-ok`, `bg-night`. Daardoor werkt het lichte thema vanzelf.
- **Tekststijlen via de classes** `text-display`, `text-h1` t/m `text-h4`, `text-body-lg`, `text-body`, `text-body-sm`, `text-label`, `text-caption`.
- **Thema:** `data-theme="dark"` of `"light"` op `<html>`. Donker is standaard. Voor uitzonderingen in licht bestaat de variant `light:` (bijv. `light:hidden`).
- **Particulier/zakelijk:** de keuze staat als `data-klant` op `<html>`. Met de variant `zakelijk:` toon je andere inhoud (bijv. `zakelijk:hidden` / `hidden zakelijk:flex`, zie de knoppen in `pages/home/hero.blade.php`).
- **Foto's** altijd uit `public/images` laden met `asset()`, nooit direct van een andere website.
- **Display-classes niet via `class` aan `x-button` meegeven** (`hidden`, `block`): de knop heeft zelf `inline-flex` en dat botst. Zet er een `<div class="hidden xl:block">` omheen.
- **Lange Nederlandse woorden in koppen** breken slecht op mobiel. Zet zo nodig `&shy;` op de plek waar het woord mag afbreken.
- **Responsive:** mobiel eerst, breekpunten `sm`, `md`, `lg`, `xl`. Geen horizontaal scrollen op 390 px breed.
- **Taal:** teksten op de site in het Nederlands met "u". Commentaar en namen van variabelen in views mogen Nederlands zijn; PHP-klassen en methodes in het Engels.
- **Git:** werk op een feature-branch (`feature/naam`), niet direct op `main`. Commit pas als erom gevraagd wordt.

## Ontwerp

- **Figma:** https://www.figma.com/design/R0sfXlvbUPiLMl6KRgFEpm/Untitled?node-id=7-2 → pagina "Ontwerp v2 – losse pagina's". 11 pagina's, donker (bovenste rij) en licht (onderste rij, "– Licht"), 1440 px breed met 1200 px inhoud.
- De Figma-variabelen heten `bg/page`, `surface/1`, `text/primary` enzovoort; in `app.css` staat bij elke kleur welke Figma-naam erbij hoort.
- Kleurcollecties in Figma: "FFS Kleuren" (donker) en "FFS Kleuren Light". Pas kleuren aan via de variabele, niet door lagen los te kleuren.
- Er is **geen mobiel ontwerp**; mobiel bepalen we zelf in de code.
- Nog niet ontworpen: mobiele versies, winkelmand en checkout, juridische pagina's, adminpanel.
- **Trello (planning):** https://trello.com/b/AiW3BQd8/full-force-systems-website-webshop. Tamzid heeft ook een eigen kopie, "full force systems tamzz"; aanpassingen daarop staan niet op het teambord.

## Vaste gegevens uit het wensenformulier

- **Uitstraling:** donker en krachtig; professioneel, zakelijk, overzichtelijk. Kleuren zwart, rood, wit.
- **Contact:** Roggeweg 30K, 6534 AJ Nijmegen · 0487-845422 · info@fullforcesystems.nl · werkdagen 10:00–17:00. **Geen WhatsApp.**
- **Werkgebied:** Gelderland, Brabant, Limburg.
- **Diensten:** camerabewaking, alarmsystemen, toegangscontrole, video-intercom, onderhoud/service. Camera en alarm staan centraal.
- **Webshopcategorieën:** camera's, recorders (NVR/DVR), kabels/accessoires, alarmsystemen, toegangscontrole, intercom. Geen bodycams of zaklampen.
- **Hoofdactie:** particulier → "Pakket bekijken"; zakelijk → "Offerte aanvragen".
- **Prijzen:** vaste prijs voor particulier, vanaf-prijs voor zakelijk. Particulier en zakelijk zien dezelfde producten en prijzen.
- **Werkwijze:** voorstel → akkoord → afspraak → installatie.
- **Betalen:** iDEAL en bankoverschrijving.
- **Offerteformulier:** naam, bedrijfsnaam, e-mail, telefoon, postcode/plaats, particulier/zakelijk, gewenste dienst, product(en), omschrijving.
- **Account:** registreren/inloggen, e-mail bevestigen, wachtwoord vergeten, "onthoud mij", adressen, bestelgeschiedenis, aanvragen terugzien, favorieten, accounttype.
- **Niet doen:** nieuwsberichten, nieuwsbrief, medewerkers op de site, klantreviews.
- **Partners die genoemd mogen worden:** Full Force Security, PNBS Security, Parabellen, Card Multiverse, The Rolling Office, Resecure, Safety First Academy, Makay Security, Flex Force Direct, EMB Security, TaskTime.
- **Echt project:** Tax administraties, Beuningen (GLD), camera- en alarmsysteem.
- **Hosting:** Antagonist, domein www.fullforcesystems.nl; toegang volgt later.

## Wat nog voorbeelddata is

Vervang dit zodra de opdrachtgever het aanlevert, en laat het tot die tijd herkenbaar als voorbeeld:

- Pakketten Basis/Plus/Compleet met prijzen en inhoud
- Productnamen, prijzen en specificaties
- Twee van de drie projecten ("Winkelpand (voorbeeld)", "Woonhuis (voorbeeld)")
- Het logo (nu een rood blokje "FF" in `x-logo`)
- Foto's: tijdelijke Unsplash-foto's in `public/images/voorbeeld/`; later eigen foto's van de opdrachtgever. Let op: bij "Tax administraties" staat nu een stockfoto, geen foto van het echte project
- KvK-nummer (het ingevulde nummer heeft 7 cijfers, moet 8 zijn) en btw-nummer ontbreken nog
- Antwoorden op de veelgestelde vragen
- Juridische teksten (privacy, voorwaarden, cookies, retour) bestaan nog niet

## Open punten

- Navragen bij de opdrachtgever: KvK-nummer (7 i.p.v. 8 cijfers), btw-nummer, logo, productgegevens, projectfoto's en definitieve pakketten.
- Zodra een pagina bestaat: `'route'` invullen in `config/site.php` (`nav`). De link gaat dan vanzelf naar de pagina in plaats van naar het blok op de homepage.
- Laravel Boost is niet geïnstalleerd. Het bestand `CLAUDE.md` in de hoofdmap vraagt daarom; overleg met Tawfik of jullie dat willen.
- Trello: de zes checklists "OUD - verwijderen" staan er nog, en afgeronde taken zijn nog niet afgevinkt.
