# Full Force Systems – volledige overdracht voor Claude in VS Code

> **Voor de AI:** lees dit bestand helemaal voordat je iets wijzigt. Het vat alles samen wat er tot en met 09-11-2026 over dit project bekend is.
> Antwoord in het **Nederlands, in eenvoudige taal**. Het team bestaat uit twee mbo-4 studenten Software Developer.
> Kort overzicht en afspraken: `docs/project-context.md`. Bij twijfel geldt dit bestand plus de code zelf.

---

## 1. Het project in het kort

| | |
|---|---|
| **Wat** | Nieuwe website met webshop en klantomgeving voor **Full Force Systems** |
| **Bedrijf** | Handelsnaam van Full Force Security BV, Roggeweg 30K, 6534 AJ Nijmegen |
| **Wat het bedrijf doet** | Beveiligingstechniek verkopen en installeren: camerabewaking, alarmsystemen, toegangscontrole, video-intercom, onderhoud/service. Camera en alarm staan centraal. |
| **Opdrachtgever** | Nick Renssen (eigenaar). Hij gaf het team vrijheid om zelf met ideeën te komen. |
| **Team** | Tawfik Alabed (eigenaar van de repository `Ryzex911/full-force-systems`) en Tamzid Mehedi (GitHub `tamz-z`). Allebei mbo-4 Software Developer, ROC Nijmegen. |
| **Repository** | https://github.com/Ryzex911/full-force-systems |
| **Lokaal (Tamzid)** | Laragon op Windows, map `C:\laragon\www\Project-Full Force` (let op de spatie: `cd "C:\laragon\www\Project-Full Force"`) |
| **Bron van alle inhoud** | Het ingevulde **wensenformulier van 23-09-2026**. Verzin **geen** bedrijfsgegevens. Wat niet in het formulier staat, is voorbeelddata en moet herkenbaar blijven als voorbeeld. |
| **Oude website** | fullforcesecurity.nl. Die gaat over beveiligers (personeel), niet over techniek. Die diensten horen **niet** op de nieuwe site. |
| **Niet verwarren** | "HitchTracker" (taxischerm, hackathon) is een losse schoolopdracht van Tawfik en hoort niet bij dit project. |

---

## 2. Vaste gegevens uit het wensenformulier

- **Uitstraling:** donker en krachtig; professioneel, zakelijk, overzichtelijk. Kleuren zwart, rood en wit.
- **Contact:** Roggeweg 30K, 6534 AJ Nijmegen · 0487-845422 · info@fullforcesystems.nl · werkdagen 10:00–17:00. **Geen WhatsApp.**
- **Werkgebied:** Gelderland, Brabant, Limburg.
- **Diensten:** camerabewaking, alarmsystemen, toegangscontrole, video-intercom, onderhoud/service.
- **Webshopcategorieën:** camera's, recorders (NVR/DVR), kabels/accessoires, alarmsystemen, toegangscontrole, intercom. **Geen** bodycams of zaklampen.
- **Hoofdactie:** particulier → "Pakket bekijken"; zakelijk → "Offerte aanvragen".
- **Prijzen:** vaste prijs voor particulier, vanaf-prijs voor zakelijk. Particulier en zakelijk zien dezelfde producten en prijzen.
- **Werkwijze:** voorstel → akkoord → afspraak → installatie.
- **Betalen:** iDEAL en bankoverschrijving.
- **Offerteformulier:** naam, bedrijfsnaam, e-mail, telefoon, postcode/plaats, particulier/zakelijk, gewenste dienst, product(en), omschrijving.
- **Account:** registreren/inloggen, e-mail bevestigen, wachtwoord vergeten, "onthoud mij", adressen, bestelgeschiedenis, aanvragen terugzien, favorieten, accounttype.
- **Niet doen:** nieuwsberichten, nieuwsbrief, medewerkers op de site, klantreviews.
- **Partners die genoemd mogen worden:** Full Force Security, PNBS Security, Parabellen, Card Multiverse, The Rolling Office, Resecure, Safety First Academy, Makay Security, Flex Force Direct, EMB Security, TaskTime.
- **Echt project:** Tax administraties, Beuningen (GLD), camera- en alarmsysteem.
- **Hosting:** Antagonist, domein www.fullforcesystems.nl. Toegang volgt later.
- **KvK-nummer:** in het formulier staan 7 cijfers, dat moeten er 8 zijn. Het btw-nummer ontbreekt. Allebei nog navragen. In `config/legal.php` staan ze op `null`.

---

## 3. Waar we nu staan (09-11-2026)

### Fase
**Front-end en opmaak zijn af.** Alle 11 pagina's uit Figma bestaan, plus winkelwagen, zoeken en project detail.
Nog **niet** gedaan, en dat is de volgende fase: database voor bestellingen/aanvragen/adressen/favorieten, afrekenen (iDEAL/bankoverschrijving) en het adminpanel.

### Branches
| Branch | Status | Inhoud |
|---|---|---|
| `main` | op GitHub | Alles tot en met PR #5 (juridische pagina's, Tawfik) en PR #6 (pakketten, webshop, dienst detail) |
| `feature/projecten` | gepusht, **nog geen PR** | Projectenpagina, reparatie van `routes/web.php` na de merge, account-icoon in de header |
| `feature/paginas-afmaken` | **lokaal, nog niet gecommit** (vanaf `feature/projecten`) | Productdetail, winkelwagen, favorieten, zoeken, project detail, Mijn account, profielpagina in huisstijl, fixes in het werk van Tawfik, Nederlandse meldingen. 107 tests. |
| `Authenticatie-bouwen` | op GitHub (Tawfik) | Breeze-authenticatie, al samengevoegd |

**Eerst doen:** in de projectmap `git checkout -b feature/paginas-afmaken`, `php artisan test`, de pagina's nalopen, committen, pushen en twee pull requests maken (`feature/projecten` en `feature/paginas-afmaken`).

### Alle pagina's (routes)

| Pagina | URL | Route | Controller | View | Figma |
|---|---|---|---|---|---|
| Home | `/` | `home` | `HomeController` | `pages/home.blade.php` + `pages/home/` | 01 |
| Diensten | `/diensten` | `diensten` | `ServiceController@index` | `pages/diensten.blade.php` + `pages/diensten/` | 02 |
| Dienst detail (5×) | `/diensten/{slug}` | `diensten.show` | `ServiceController@show` | `pages/dienst.blade.php` + `pages/dienst/` | 03 |
| Pakketten | `/pakketten` | `pakketten` | `PackageController` | `pages/pakketten.blade.php` + `pages/pakketten/` | 04 |
| Webshop | `/webshop` | `webshop` | `WebshopController@index` | `pages/webshop.blade.php` + `pages/webshop/` | 05 |
| Productdetail | `/webshop/{slug}` | `webshop.show` | `WebshopController@show` | `pages/product.blade.php` + `pages/product/` | 06 (node `11:1496`) |
| Projecten | `/projecten` | `projecten` | `ProjectController` (`__invoke`) | `pages/projecten.blade.php` + `pages/projecten/` | 07 |
| Project detail | `/projecten/{slug}` | `projecten.show` | `ProjectController@show` | `pages/project.blade.php` | geen ontwerp |
| Over ons | `/over-ons` | `over-ons` | `AboutController` | `pages/over-ons.blade.php` + `pages/over-ons/` | 08 |
| Contact en offerte | `/contact` (GET + POST) | `contact`, `contact.store` | `ContactController` | `pages/contact.blade.php` + `pages/contact/` | 09 |
| Inloggen/registreren | `/login`, `/register` | Breeze | `Auth\*` | `auth/*.blade.php` + `layouts/guest.blade.php` | 10 (node `12:2180`) |
| Mijn account | `/account` | `account` | `AccountController@index` | `pages/account/index.blade.php` + `layouts/account.blade.php` | 11 (node `12:2362`) |
| Mijn bestellingen | `/account/bestellingen` | `account.bestellingen` | `AccountController@orders` | `pages/account/bestellingen.blade.php` | – |
| Mijn aanvragen | `/account/aanvragen` | `account.aanvragen` | `AccountController@quotes` | `pages/account/aanvragen.blade.php` | – |
| Favorieten | `/account/favorieten` | `account.favorieten` | `AccountController@favorites` | `pages/account/favorieten.blade.php` | – |
| Adresboek | `/account/adressen` | `account.adressen` | `AccountController@addresses` | `pages/account/adressen.blade.php` | – |
| Gegevens wijzigen | `/profile` | `profile.edit` (+ update/destroy) | `ProfileController` (Breeze) | `profile/edit.blade.php` + `profile/partials/` | – |
| Winkelwagen | `/winkelwagen` | `winkelwagen` (+ `.store`, `.update`, `.destroy`) | `CartController` | `pages/winkelwagen.blade.php` | niet ontworpen |
| Favoriet aan/uit | `POST /favorieten/{slug}` | `favorieten.toggle` | `FavoriteController` | – | – |
| Zoeken | `/zoeken?q=` | `zoeken` | `SearchController` | `pages/zoeken.blade.php` | – |
| Juridisch overzicht + 7 pagina's | `/juridisch`, `/juridisch/privacyverklaring` enz. | `legal.index`, `legal.privacy`, `legal.terms`, `legal.cookies`, `legal.returns`, `legal.shipping`, `legal.warranty`, `legal.complaints` | `Route::view` | `legal/index.blade.php`, `legal/page.blade.php` + `layouts/legal.blade.php` (teksten in `config/legal.php`) | niet ontworpen |
| Oud dashboard | `/dashboard` | `dashboard` | redirect naar `/account` (Breeze stuurt na inloggen naar `dashboard`) | – | – |

Accountpagina's hebben de middleware `auth` + `verified`; `/profile` alleen `auth`.

### Wie wat gebouwd heeft
- **Tamzid (met Claude):** huisstijl, basislayout, componenten, home, diensten, dienst detail, pakketten, webshop, over ons, contact, projecten, productdetail, winkelwagen, zoeken, project detail, Mijn account, profielpagina in huisstijl, tests.
- **Tawfik:** authenticatie (Laravel Breeze, met particulier/zakelijk bij registreren), juridische pagina's (eigen layout `layouts/legal.blade.php` met `public/css/legal.css` en `public/js/legal.js`), inlogpagina's (eigen lichte opmaak `layouts/guest.blade.php` met `public/css/full-force-auth.css` en `public/js/full-force-auth.js`).
  → **Overleg met Tawfik voordat je zijn opmaak verandert.** Alleen echte fouten zijn al hersteld (zie §8).

---

## 4. Techniek

- **Laravel 13**, **PHP 8.4+**. Verplicht: `symfony/clock` in `composer.lock` werkt niet op 8.3. In Laragon: rechtsklik → PHP → Version → 8.4, en open daarna een nieuwe terminal.
- **Blade**, **Tailwind CSS 4** via Vite (`@tailwindcss/vite`). Er is **geen** `tailwind.config.js` nodig; `tailwind.config.js` en `postcss.config.js` zijn restjes van Tailwind 3.
- Lettertype **Inter** via de fonts-optie van `laravel-vite-plugin` (`bunny('Inter', …)` in `vite.config.js`) en `@fonts` in de layout.
- **Database:** lokaal SQLite (`database/database.sqlite`), later MySQL. De sessies staan in de database: zonder `php artisan migrate` crasht elke pagina.
- **Auth:** Laravel Breeze. `User` implementeert `MustVerifyEmail`. Extra kolommen `account_type` (`particulier`/`zakelijk`) en `company_name` (migratie `2026_10_15_122020_add_customer_account_fields_to_users_table.php`).
- **Mail:** lokaal `MAIL_MAILER=log`, dus mails (offertes, bevestigingslinks, wachtwoord vergeten) staan in `storage/logs/laravel.log`. Bij livegang `smtp` met de gegevens van Antagonist.
- **Taal:** `APP_LOCALE=nl`. Nederlandse meldingen staan in `lang/nl/` (`auth.php`, `passwords.php`, `validation.php`, `pagination.php`) en `lang/nl.json` (teksten van de Breeze-e-mails).
- **Geen Alpine.js**: het wordt niet geladen. De Breeze-componenten die het nodig hebben (modal, dropdown) worden niet meer gebruikt. Al het gedrag zit in `resources/js/app.js`.

### Starten (eerste keer)
```
composer install
copy .env.example .env
php artisan key:generate
type nul > database\database.sqlite
php artisan migrate
npm install
npm run dev
```
In een tweede terminal: `php artisan serve` → http://127.0.0.1:8000

### Testen
```
php artisan test
```
107 tests, ze moeten allemaal slagen. Bij inloggen moet het e-mailadres bevestigd zijn voor `/account`. De bevestigingslink staat in `storage/logs/laravel.log`.

---

## 5. Opbouw van de code

| Wat | Waar |
|---|---|
| Kleuren (donker/licht), tekststijlen, `.wrap`, `.card`, `.icon-tile`, varianten `light:` en `zakelijk:` | `resources/css/app.css` |
| Bedrijfsgegevens, menu (`nav`), diensten (met teksten van de detailpagina's), werkwijze, partners | `config/site.php` → `config('site.phone')` enz. |
| Juridische teksten, KvK/btw, `approved` (noindex zolang `false`) | `config/legal.php` |
| **Voorbeelddata** pakketten, vergelijkingstabel, categorieën, 9 producten (met teksten, specificaties en "vaak samen gekocht"), projecten | `app/Support/Catalog.php` |
| Winkelwagen in de sessie | `app/Support/Cart.php` |
| Favorieten in de sessie | `app/Support/Favorites.php` |
| **Voorbeelddata** bestellingen, aanvragen, adressen, statuskleuren | `app/Support/ExampleAccount.php` |
| Links: menu-item, pagina die misschien nog niet bestaat, offerteformulier met ingevulde keuze | `app/Support/Nav.php` |
| Formuliercontrole met Nederlandse meldingen | `app/Http/Requests/QuoteRequest.php`, `CartItemRequest.php` |
| E-mails bij een offerte | `app/Mail/QuoteRequested.php` (naar bedrijf), `QuoteReceived.php` (bevestiging), `resources/views/mail/offerte/` |
| Hoofdlayout | `resources/views/layouts/app.blade.php` |
| Layout Mijn account (kop + zijmenu) | `resources/views/layouts/account.blade.php` |
| Header, footer, CTA-blok, werkwijze, keuze particulier/zakelijk, partners, paginering, meldingsbalk | `resources/views/partials/` |
| Foutpagina's 404, 419, 429 | `resources/views/errors/` |
| Gedrag: thema, mobiel menu, particulier/zakelijk, webshopfilters, aantal −/+, tabbladen | `resources/js/app.js` |
| Tijdelijke foto's (Unsplash, lokaal) | `public/images/voorbeeld/` |
| Favicon en iPhone-icoon (tijdelijk "FF") | `public/favicon.svg`, `public/apple-touch-icon.png` |
| Ontwerpen + stappenplan van pagina's 03/04/05 | `docs/ontwerp/`, `docs/opdracht-pakketten-webshop-dienstdetail.md` |
| Tests | `tests/Feature/` |

### Componenten (`resources/views/components/`)
| Component | Gebruik |
|---|---|
| `x-button` | `variant`: `primary` (rood), `secondary` (rand), `on-image`, `link` (rode tekst met pijl). Met `href` een `<a>`, zonder een `<button type="button">`; voor formulieren `type="submit"`. |
| `x-icon` | `<x-icon name="camera" class="size-6" />`. Iconen: camera, alarm, lock, intercom, wrench, shield, check, arrow, cart, user, users, search, pin, phone, mail, clock, recorder, cable, heart, home, building, menu, close, plus, minus, alert, check-circle, sun, moon, file, box, logout, trash. Nieuw icoon: voeg een regel toe in de array (24×24, alleen lijnen). |
| `x-logo` | Tijdelijk logo (rood blokje "FF") |
| `x-page-header` | Kop van elke vervolgpagina: kruimelpad (`:crumbs`), titel tussen de tags, `text`, slots `actions` en `media` |
| `x-breadcrumbs` | Los kruimelpad (productpagina). "Home" staat er altijd vooraan. |
| `x-section-heading` | `label` (klein rood) + `title` + optioneel `text` |
| `x-field` | Formulierveld: `name`, `label`, `type` (text, email, tel, number, search, password, textarea, select + `:options`), `required`, `hint`, `size="sm"`, `icon`, `:hide-label`, `:mark-optional`, `:placeholder="false"`, `id` (als hetzelfde veld twee keer op een pagina staat), `bag` (error bag van Breeze, bijvoorbeeld `updatePassword`, `userDeletion`) |
| `x-check-list` | Opsomming met rode vinkjes: `:items="[...]"` |
| `x-service-card` | `icon`, `title`, `text`, optioneel `href` |
| `x-product-card` | Geef `:slug` mee, dan linken foto en titel naar de productpagina en zet de knop het product in de winkelwagen. Verder `icon`, `category`, `title`, `price`, `image`, `:in-stock` (niet op voorraad → "Product aanvragen") |
| `x-project-card` | `tag`, `title`, `location`, `image`, `alt`, `href` |
| `x-package-card` | Pakketkaart (pakketten en home) |
| `x-quantity` | Aantal met − en +: `name`, `:value`, `:min`, `label`, `id` |
| `x-status` | Statuslabel: `<x-status status="Verzonden" />` (kleuren in `ExampleAccount::STATUS_COLORS`) |
| Breeze-restjes (`primary-button`, `text-input`, `modal`, `dropdown`, `nav-link` …) | Worden door onze pagina's niet gebruikt. Gebruik ze niet voor nieuwe pagina's. |

---

## 6. Afspraken (houd je hier altijd aan)

- **Nieuwe pagina:** `@extends('layouts.app')`, inhoud in `@section('content')`, `@section('title', '...')` en `@section('description', '...')`, bestand in `resources/views/pages/`. Grote pagina's opsplitsen in secties in een eigen map (zoals `pages/home/`).
- **Vervolgpagina's beginnen met `x-page-header`.** Blokken die vaker terugkomen: `@include('partials.werkwijze')`, `@include('partials.cta')`. Het CTA-blok accepteert `ctaTitel`, `ctaTekst`, `ctaFoto` en `ctaOfferte`.
- **Per nieuwe pagina:** route **met naam** in `routes/web.php`. Staat de pagina in het menu, vul de routenaam in bij `'route'` in `config/site.php` (`nav`). Voeg de routenaam toe aan `$pages` (of `urls()` / `$accountPages`) in `tests/Feature/LinksTest.php`, en schrijf een eigen test `tests/Feature/<Naam>PageTest.php`.
- **Geen dode links.** Nooit `href="#"`. Voor een pagina die misschien nog niet bestaat: `@if ($link = Nav::page('naam'))`. "Offerte aanvragen" altijd met `Nav::quote()`, eventueel met een keuze: `Nav::quote(['dienst' => 'camerabewaking'])`, `['pakket' => 'Plus']`, `['product' => '...']`, `['klant' => 'zakelijk']`. `LinksTest` volgt elke link op elke pagina.
- **Hergebruik de componenten.** Maak geen tweede soort knop of kaart; breid de bestaande uit.
- **Formulieren:** velden met `x-field`, verzendknop `<x-button type="submit">`, controle in een Form Request met Nederlandse meldingen.
- **Kleuren alleen via de tokens**, nooit losse hex-codes in Blade: `bg-page`, `bg-alt`, `bg-surface`, `bg-surface-2`, `border-line`, `text-ink`, `text-ink-2`, `text-ink-3`, `bg-brand`, `hover:bg-brand-dark`, `text-brand-ink`, `bg-brand-soft`, `text-ok`, `bg-ok-soft`, `bg-night`. Dan werkt het lichte thema vanzelf.
- **Tekststijlen:** `text-display`, `text-h1` t/m `text-h4`, `text-body-lg`, `text-body`, `text-body-sm`, `text-label`, `text-caption`.
- **Thema:** `data-theme="dark"`/`"light"` op `<html>`, donker is standaard. Uitzonderingen: `light:hidden` enz.
- **Particulier/zakelijk:** `data-klant` op `<html>`. Gebruik `zakelijk:hidden` / `hidden zakelijk:flex`. Knoppen of links die de keuze vastzetten krijgen `data-kies-klant="zakelijk"`.
- **Foto's** altijd uit `public/images` met `asset()`, nooit van een andere website.
- **Responsive:** mobiel eerst, breekpunten `sm`, `md`, `lg`, `xl`. **Geen horizontaal scrollen op 390 px.** Controleer elke pagina op 1440 en 390 px, in donker en licht.
- **Taal op de site:** Nederlands, met **"u"** (niet "je"). Commentaar en variabelen in views mogen Nederlands zijn; PHP-klassen en -methodes in het Engels.
- **Voorbeelddata** blijft herkenbaar: zet er een zichtbare regel onder ("Voorbeeldproducten …") en een `{{-- TODO: weghalen zodra … --}}`.
- **Melding na een actie:** `return back()->with('melding', ['tekst' => '...', 'link' => url, 'linkTekst' => '...']);` (gebruik niet `status`, dat gebruikt Breeze al).
- **Git:** werk op een feature-branch (`feature/naam`), nooit direct op `main`. **Commit pas als erom gevraagd wordt.** Pushen doet het team zelf.

### Valkuilen die we al tegenkwamen
1. **`@php(...)` en `@php … @endphp` niet mengen in één Blade-bestand.** Dan geeft Blade een parse error ("unexpected endforeach"). Gebruik altijd de lange vorm `@php … @endphp`.
2. **Tailwind 4: geen varianten op eigen classes uit `@layer components`.** `lg:card` werkt dus niet; schrijf `lg:rounded-xl lg:border lg:border-line lg:bg-surface`.
3. **Sr-only tekst in een scrollblok:** zet `relative` op het blok eromheen, anders wordt de pagina op mobiel breder.
4. **Grid op mobiel:** gebruik `minmax(0, 1fr)` in plaats van `1fr` als er een rij met `white-space: nowrap` in staat. Dat was de oorzaak van het opzij scrollen op de juridische pagina's.
5. **Geen display-classes (`hidden`, `block`) via `class` aan `x-button`:** de knop is zelf `inline-flex`. Zet er een `<div class="hidden xl:block">` omheen.
6. **Foutpagina's (404) hebben geen `$errors`.** `x-field` vangt dat al op; let erop in nieuwe componenten.
7. **Lange Nederlandse woorden in koppen** breken slecht af op mobiel. Zet `&shy;` op de plek waar het woord mag afbreken.
8. **Pint** (`vendor/bin/pint`) maakt hele bestanden opnieuw op. Draai het niet op bestanden van Tawfik (zoals `config/legal.php`), anders krijg je een enorme diff.
9. **Testgebruiker zonder bevestigd e-mailadres** komt bij `/account` op "Bevestig uw e-mailadres" terecht. Dat is goed gedrag, geen fout.

---

## 7. Hoe de belangrijkste onderdelen werken

### Winkelwagen (`App\Support\Cart`)
- In de sessie staat alleen `slug => aantal` onder de sleutel `winkelwagen`. Prijzen en namen komen altijd opnieuw uit `Catalog`, zodat niemand een prijs kan aanpassen.
- Methodes: `items()`, `add($slug, $aantal)`, `set($slug, $aantal)` (0 = weghalen), `remove($slug)`, `count()`, `lines()`, `total()`, `summary()` ("2× Bewegingsmelder, 1× …"), `MAX_QUANTITY = 99`.
- `CartController`: `index`, `store` (POST `product` + `aantal`), `update` (PATCH), `destroy` (DELETE). Controle in `CartItemRequest`.
- "Producten aanvragen" gaat naar `Nav::quote(['product' => Cart::summary()])`. Het veld "product(en)" is maximaal 255 tekens.
- In de winkelwagen verstuurt het formulier zichzelf als het aantal verandert (`data-auto-verzenden`); zonder JavaScript is er een knop "Bijwerken" (`data-zonder-js`).
- Het icoon in de header toont het aantal (`Cart::count()`).
- **Later (database):** vervang `Cart` door een tabel; de controller en de views kunnen blijven.

### Favorieten (`App\Support\Favorites`)
- Sessie-sleutel `favorieten` met een lijst slugs. Methodes `slugs()`, `has()`, `toggle()`, `products()`.
- Werkt ook zonder account. Later opslaan bij de gebruiker.

### Productpagina
- `Catalog::product($slug)` geeft één product, of `null` (dan 404). Elk product heeft: `slug`, `title`, `category`, `category_slug`, `icon`, `amount`, `price`, `image`, `in_stock`, `offer`, `featured`, `text`, `heading`, `description`, `features`, `specs`, `related`.
- Tabbladen met `data-tabs` / `data-tab` / `data-tab-paneel`. Zonder JavaScript staan alle panelen onder elkaar. Met `#tab-specificaties` in de URL opent dat tabblad meteen.

### Zoeken (`SearchController`)
- Zoekt in producten, diensten, pakketten en projecten. Alle woorden moeten voorkomen ("camera buiten"). Resultaten per groep; zonder zoekterm zie je "Veel gezocht".

### Mijn account
- `layouts/account.blade.php`: kop "Welkom, naam" met het label Particulier/Zakelijk account (en de bedrijfsnaam bij zakelijk), plus het zijmenu (op mobiel een rij knoppen die opzij schuift). Pagina's gebruiken `@extends('layouts.account')` en `@section('account')`.
- Echt: naam, e-mail, accounttype, favorieten. **Voorbeeld:** bestellingen (#FFS-1026, #FFS-1022, #FFS-1015), aanvragen, adres "Voorbeeldstraat 12, 6500 AB Nijmegen".
- "Gegevens" en "Wachtwoord wijzigen" gaan naar `/profile` (`#gegevens`, `#wachtwoord`). "Account verwijderen" zit in een uitklapblok (`<details>`).

### Offerteformulier
- `/contact?dienst=…&pakket=…&product=…&klant=zakelijk` vult velden vooraf in.
- Na versturen: een mail naar info@fullforcesystems.nl (met Reply-To naar de klant) en een bevestiging naar de klant. Er is een spamfilter (honeypot) en throttle 5 per minuut.
- Aanvragen worden **nog niet opgeslagen**, alleen gemaild.

---

## 8. Wat al hersteld is in het werk van Tawfik
- Juridische pagina's scrolden op mobiel ruim 1000 px opzij. Opgelost in `public/css/legal.css` (`minmax(0, 1fr)` + `min-width: 0` op `.legal-sidebar`).
- "je" → "u" in `auth/*.blade.php`, `layouts/guest.blade.php`, `legal/index.blade.php`, `layouts/legal.blade.php` en de klachtenprocedure in `config/legal.php`.
- Engelse foutmeldingen ("These credentials do not match our records.") → Nederlands via `lang/nl/`.
- De profielpagina was standaard Breeze (Engels, wit) → nu huisstijl en Nederlands, binnen Mijn account.
- **Niet aangepast (bewust, eerst overleggen):** de lichte opmaak van inloggen/registreren (wijkt af van Figma 10, dat donker is met inloggen en registreren naast elkaar) en de aparte header van de juridische pagina's.

---

## 9. Bewust afgeweken van Figma (bespreken met Tawfik)
- Winkelwagen: "Producten aanvragen" in plaats van "Afrekenen", tot het afrekenen er is.
- Productpagina: geen kleine extra foto's onder de grote foto (elk product heeft er maar één of geen).
- Mijn account: het accounttype staat onder de titel in plaats van ernaast; op mobiel is het zijmenu een rij knoppen.
- Webshop: paginering pas bij meer dan 9 producten; "Alleen op voorraad" niet standaard aangevinkt.
- Dienstenpagina: knop "Meer informatie" bij elke dienst.
- Over ons en Contact zijn gebouwd zonder Figma; vergelijk ze nog met ontwerp 08 en 09.
- Winkelwagen, zoeken, project detail en de accountsubpagina's hebben geen Figma-ontwerp; ze zijn gebouwd in de stijl van de bestaande pagina's.

---

## 10. Wat nog voorbeelddata is
Vervang dit zodra de opdrachtgever het aanlevert, en laat het tot die tijd herkenbaar als voorbeeld:
- Pakketten Basis (€ 899) / Plus (€ 1.499) / Compleet (€ 2.299), inhoud en vergelijkingstabel (`Catalog`)
- De 9 producten: namen, prijzen, voorraad, teksten, specificaties, "vaak samen gekocht" (`Catalog`)
- Bestellingen, aanvragen en adressen in Mijn account (`ExampleAccount`)
- Teksten van de detailpagina's Alarmsystemen, Toegangscontrole, Video-intercom en Onderhoud & service (`'example' => true` in `config/site.php`); alleen Camerabewaking komt uit het ontwerp
- Twee van de drie projecten ("Winkelpand (voorbeeld)", "Woonhuis (voorbeeld)")
- Het logo (rood blokje "FF" in `x-logo`), favicon en `favicon.ico` (leeg bestand)
- Alle foto's (Unsplash, in `public/images/voorbeeld/`). Bij "Tax administraties" staat een stockfoto, geen foto van het echte project.
- KvK-nummer (7 i.p.v. 8 cijfers) en btw-nummer
- Antwoorden op de veelgestelde vragen
- Juridische teksten zijn concepten (banner "Concept voor schoolproject", `noindex` zolang `config('legal.approved')` `false` is); ze moeten worden goedgekeurd

---

## 11. Open punten en volgende stappen

### Nu
1. `feature/paginas-afmaken` committen en pushen; pull requests voor `feature/projecten` en `feature/paginas-afmaken`.
2. Met Tawfik bespreken:
   - de afwijkingen uit §9;
   - de opmaak van inloggen/registreren en de juridische pagina's (eigen layouts, geen hoofdmenu, lichte stijl);
   - `composer.json` heeft `"laravel/breeze": "*"` bij `require`, waardoor `composer.lock` niet klopt (waarschuwing bij `composer install`). Oplossing: Breeze naar `require-dev` met een vaste versie, dan `composer update laravel/breeze`;
   - `resources/views/dashboard.blade.php` wordt niet meer gebruikt en mag weg (`git rm`);
   - `tailwind.config.js` en `postcss.config.js` (Tailwind 3) kunnen weg;
   - Laravel Boost: het bestand `CLAUDE.md` in de hoofdmap vraagt om het te installeren. Dat is nog niet gedaan; samen beslissen.
3. Over ons, Contact en Inloggen/registreren naast Figma (08, 09, 10) leggen.

### Volgende fase (database)
1. Database ontwerpen: `orders` + `order_items`, `quotes` (met statussen uit het wensenformulier), `addresses`, `favorites`, later `products` en `categories`.
2. `Cart`, `Favorites` en `ExampleAccount` vervangen door modellen; de views kunnen grotendeels blijven.
3. Offerteaanvragen ook opslaan (en tonen in Mijn aanvragen).
4. Afrekenen met iDEAL en bankoverschrijving (bijvoorbeeld via Mollie), checkout-pagina's (nog niet ontworpen).
5. Adminpanel: producten, bestellingen, offertes en statistieken beheren (nog niet ontworpen).
6. SEO: `sitemap.xml` ontbreekt nog; `robots.txt` laat alles toe.

### Bij livegang (Antagonist)
- `.env` op de server: `APP_ENV=production`, `APP_DEBUG=false`, `MAIL_MAILER=smtp` met de mailgegevens van Antagonist (zonder dat komen offerteaanvragen niet aan), MySQL-gegevens.
- `config/legal.php`: KvK, btw en `approved => true` zodra de teksten zijn goedgekeurd.

### Navragen bij de opdrachtgever
KvK-nummer (8 cijfers), btw-nummer, logo, echte producten en prijzen, definitieve pakketten, projectfoto's en meer projecten (met toestemming van de klant), antwoorden op de veelgestelde vragen, goedkeuring van de juridische teksten en van de vier voorbeeldteksten van de diensten.

---

## 12. Ontwerp en planning
- **Figma:** https://www.figma.com/design/R0sfXlvbUPiLMl6KRgFEpm/Untitled?node-id=7-2 → pagina "Ontwerp v2 – losse pagina's". 11 pagina's: donker (bovenste rij) en licht (onderste rij, "– Licht"), 1440 px breed met 1200 px inhoud. Nodes: 06 Productdetail `11:1496`, 10 Inloggen/registreren `12:2180`, 11 Mijn account `12:2362`.
- Figma-variabelen heten `bg/page`, `surface/1`, `text/primary` enzovoort; in `app.css` staat bij elke kleur de Figma-naam. Kleurcollecties: "FFS Kleuren" (donker) en "FFS Kleuren Light". Pas kleuren aan via de variabele.
- **Geen mobiel ontwerp**: mobiel bepalen we zelf in de code. Niet ontworpen: mobiele versies, winkelmand en checkout, juridische pagina's, adminpanel.
- **Trello (teambord):** https://trello.com/b/AiW3BQd8/full-force-systems-website-webshop. Tamzid heeft een eigen kopie, "full force systems tamzz" (aanpassingen daarop staan niet op het teambord).
  - Kaarten die naar **Klaar** mogen: Laravel project opzetten, GitHub repository opzetten, Huisstijl vastleggen, Wireframes maken, Sitemap maken, Ontwerp aanpassen aan wensenformulier, Front-end opzet kiezen en instellen, Basislayout bouwen, Publieke pagina's bouwen, Dienstenpagina's bouwen (hele checklist), Pakketten-pagina maken, Webshop frontend bouwen, Particulier en zakelijk ervaring maken, Authenticatie bouwen, Juridische pagina's toevoegen (teksten nog concept), Offerte- en contactaanvragen bouwen (behalve opslaan), Klantaccount bouwen (front-end; opslaan volgt).
  - Nog open: Winkelmand en checkout (afrekenen), Betalingen koppelen, Database ontwerpen, Productbeheer, Bestellingen beheren, Statistieken, Adminpanel, SEO en analytics, Website testen, Bugs oplossen, Hosting en livegang, Eindoplevering, Projectplan afronden, Informatie opdrachtgever verwerken, User flows maken.
  - De zes checklists "OUD - verwijderen" staan er nog.

---

## 13. Checklist voor elke wijziging
- [ ] Op een feature-branch, niet op `main`
- [ ] Componenten en tokens hergebruikt, geen losse hex-codes, tekst met "u"
- [ ] Route met naam + (indien nodig) `nav` in `config/site.php` + `LinksTest` + eigen test
- [ ] `php artisan test` slaagt helemaal
- [ ] Pagina nagekeken op 1440 en 390 px, donker en licht: geen horizontaal scrollen, geen kapotte afbeeldingen, geen fouten in de console
- [ ] Voorbeelddata herkenbaar gemaakt
- [ ] `docs/project-context.md` (en dit bestand) bijgewerkt als er iets wezenlijks verandert
- [ ] Niet committen of pushen zonder dat erom gevraagd is
