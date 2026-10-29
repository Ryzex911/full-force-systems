# Opdracht: pagina's Dienst detail, Pakketten en Webshop bouwen

Lees eerst `docs/project-context.md`. Bouw daarna deze drie pagina's precies volgens de ontwerpen:

- `docs/ontwerp/03-dienst-detail.png`
- `docs/ontwerp/04-pakketten.png`
- `docs/ontwerp/05-webshop.png`

Figma (bron van de ontwerpen): https://www.figma.com/design/R0sfXlvbUPiLMl6KRgFEpm/Untitled?node-id=7-2, pagina "Ontwerp v2 – losse pagina's", frames "03 Dienst detail – Camerabewaking", "04 Pakketten" en "05 Webshop". De lichte versie staat eronder ("– Licht"); die werkt vanzelf als je alleen de kleurtokens gebruikt.

## Regels voor alle drie de pagina's

- Alleen front-end: **voorbeelddata in de controller**, geen database, modellen of migraties.
- Werk op een nieuwe branch: `git checkout -b feature/pakketten-webshop` (vanaf de huidige branch).
- Elke pagina: `@extends('layouts.app')`, bovenaan `<x-page-header>`, onderaan `@include('partials.cta')` waar het ontwerp dat toont.
- **Hergebruik wat er al is**: `x-page-header`, `x-section-heading`, `x-button`, `x-icon`, `x-check-list`, `x-service-card`, `x-package-card`, `x-product-card`, `x-field`, `partials/werkwijze`, `partials/cta`. Maak geen nieuwe soort knop of kaart.
- Kleuren alleen via de tokens (`bg-page`, `bg-alt`, `bg-surface`, `text-ink`, `text-ink-2`, `border-line`, `bg-brand`, `text-brand-ink` …) en tekst via `text-h1` … `text-body-sm`, `text-label`. Geen losse hex-codes.
- Mobiel eerst; geen horizontaal scrollen op 390 px. Grids worden op mobiel één kolom.
- Foto's alleen uit `public/images` met `asset()`.
- Teksten in het Nederlands met "u". Neem de teksten letterlijk over uit de ontwerpen.
- Voorbeelddata herkenbaar laten (grijze notitieregel zoals in het ontwerp), want prijzen en producten volgen nog van de opdrachtgever.

---

## Stap 1 – Gedeelde data verplaatsen

De pakketten en producten staan nu in `HomeController`. Ze komen straks op meer pagina's.

1. Verplaats `packages()` en `products()` uit `HomeController` naar een eigen plek, bijvoorbeeld `app/Support/Catalog.php` met `Catalog::packages()` en `Catalog::products()`.
2. Geef elk product een `slug` en een `category` die past bij de categorieën uit het formulier: camera's, recorders, kabels & accessoires, alarmsystemen, toegangscontrole, intercom.
3. Zorg voor 9 producten (zie `05-webshop.png`): 4K IP-camera buiten, Dome-camera binnen, NVR-recorder 8 kanalen, NVR-recorder 16 kanalen, Draadloze alarmset, Bewegingsmelder, Codeklavier met taglezer, Video-deurbel met monitor, Netwerkkabel CAT6 50 m.
4. Laat `HomeController` deze nieuwe plek gebruiken. De homepage moet er precies hetzelfde uitzien.

## Stap 2 – Pagina Pakketten (`04-pakketten.png`)

Route: `GET /pakketten` → naam `pakketten`.

Secties van boven naar beneden:

1. **Paginakop** – kruimel "Pakketten", titel "Kies het pakket dat bij uw woning past", tekst "Vaste prijs, inclusief installatie en uitleg. Liever iets anders? Wij passen elk pakket aan."
2. **Drie pakketkaarten** met `x-package-card` (Basis, Plus = featured, Compleet), knoptekst "Pakket kiezen". Daaronder de grijze notitie over voorbeeldprijzen.
3. **Vergelijkingstabel** – label "Vergelijken", titel "Wat zit er in elk pakket?". Kolommen: Onderdeel, Basis, Plus, Compleet. Rijen: Buitencamera's (2/4/4), Recorder met opslag (✓/✓/✓), Alarmsysteem met sensoren (–/✓/✓), Video-intercom (–/–/✓), Installatie en uitleg (✓/✓/✓), Onderhoud & service (Optioneel). Gebruik een echte `<table>` met `<th scope="col">`; vinkje = `x-icon name="check"` in `text-brand-ink`. Op mobiel mag de tabel horizontaal scrollen **binnen** een `overflow-x-auto`-blok, de pagina zelf niet.
4. **Zakelijk-blok** – zelfde opmaak als het CTA-blok, titel "Zakelijk? Wij maken een voorstel op maat", tekst "Elk pand is anders. Na een bezoek op locatie ontvangt u een voorstel met een heldere vanaf-prijs." Knoppen: Offerte aanvragen (naar de contactpagina) en Bel 0487-845422.
5. **Werkwijze** – `@include('partials.werkwijze')`.

Daarna:
- Zet in `config/site.php` bij `nav` het item Pakketten op `'route' => 'pakketten'`.
- Laat de pakketknoppen op de homepage en "Pakket bekijken" in de hero naar `route('pakketten')` gaan.

## Stap 3 – Pagina Webshop (`05-webshop.png`)

Route: `GET /webshop` → naam `webshop`.

1. **Paginakop** – titel "Webshop", tekst "Beveiligingsproducten die wij zelf ook installeren. Particulier of zakelijk: dezelfde producten en prijzen."
2. **Twee kolommen** (desktop): links filters (264 px breed), rechts de producten.
   - **Filters:** kop "Categorieën" met "Alle producten" + de zes categorieën (actieve rood gemarkeerd); "Prijs" met twee velden Van/Tot; "Beschikbaarheid" met vinkjes "Alleen op voorraad" en "Aanbiedingen".
   - **Werkbalk:** zoekveld "Zoek producten…", tekst "9 producten", keuzelijst "Sorteer: populair".
   - **Producten:** raster van 3 kolommen met `x-product-card`.
   - **Paginering:** knoppen 1, 2, 3 (1 actief, rood).
3. Laat het filteren echt werken met een **GET-formulier** (zonder JavaScript): `?categorie=recorders&zoek=camera&voorraad=1&sorteer=prijs-laag`. Filter in de controller op de voorbeelddata met een Laravel-collection. Toon "Geen producten gevonden" als er niets overblijft.
4. Op mobiel staan de filters boven de producten (eventueel in een `<details>`-blok "Filters"), en de producten in 1 kolom (2 op tablet).

Daarna: `nav` Webshop op `'route' => 'webshop'`, en "Naar de webshop" op de homepage naar `route('webshop')`.

## Stap 4 – Pagina Dienst detail (`03-dienst-detail.png`)

Route: `GET /diensten/{slug}` → naam `diensten.show`. Eén pagina voor alle vijf diensten; de inhoud komt uit `config('site.services')`. Onbekende slug → `abort(404)`.

Voeg per dienst in `config/site.php` de extra gegevens toe die deze pagina nodig heeft: `intro` (lange tekst), `benefits` (3 kaarten met icoon, titel, tekst), `faq` (vragen) en `product_category` (welke producten erbij horen). Voor Camerabewaking staan de teksten in het ontwerp; voor de andere vier diensten schrijf je vergelijkbare teksten in dezelfde toon en markeer je ze als voorbeeld.

Secties:

1. **Kop** (op `bg-alt`): links kruimelpad Home / Diensten / Camerabewaking, titel, introtekst, knoppen "Pakket bekijken" (rood) en "Offerte aanvragen", regel "Werkgebied: Gelderland · Brabant · Limburg". Rechts een foto (540×400, afgeronde hoeken) of het icoon als er geen foto is.
2. **Wat u krijgt** – titel "Van eerste advies tot uitleg bij oplevering", drie `x-service-card`s zonder link (Advies op locatie, Montage en afstelling, Uitleg en nazorg).
3. **Prijs** – titel "Duidelijk vooraf wat het kost", twee kaarten: Particulier "Vaste prijs – vanaf pakket Basis" (knop Pakket bekijken) en Zakelijk "Vanaf-prijs – op basis van uw pand" (knop Offerte aanvragen).
4. **Werkwijze** – `@include('partials.werkwijze')`.
5. **Veelgestelde vragen** – titel "Goed om te weten". Gebruik `<details><summary>` zodat het openklapt zonder JavaScript; plus-icoon rechts. Antwoorden zijn nog voorbeeld; toon de notitie "Antwoorden volgen van de opdrachtgever."
6. **Bijpassende producten** – titel "Bijpassende producten", link "Naar de webshop", 4 `x-product-card`s uit de bijbehorende categorie.
7. **CTA** – `@include('partials.cta')`.

Daarna: op de dienstenpagina (`pages/diensten/lijst.blade.php`), de homepage en in de footer de links naar `route('diensten.show', $slug)` laten gaan in plaats van `/diensten#slug`. De knop bij elke dienst op de dienstenpagina wordt "Meer informatie".

## Stap 5 – Tests en controle

1. Voeg feature-tests toe naar het voorbeeld van `tests/Feature/ServicesPageTest.php`:
   - `/pakketten` toont drie pakketten en de vergelijkingstabel.
   - `/webshop` toont 9 producten; `?categorie=recorders` toont alleen recorders; een zoekterm zonder resultaat toont "Geen producten gevonden".
   - `/diensten/camerabewaking` werkt voor alle vijf slugs; `/diensten/bestaat-niet` geeft 404.
   - Het menu markeert de juiste pagina als actief.
2. Draai `php artisan test` – alles groen, ook de bestaande tests (pas `LinksTest` aan als links veranderd zijn).
3. Bekijk elke pagina in de browser op 1440 px en 390 px, in donker én licht. Controleer: geen horizontaal scrollen, geen kapotte afbeeldingen, geen fouten in de console.
4. Werk `docs/project-context.md` bij (stand van zaken en tabel "Opbouw van de code").
5. Commit per pagina, met een duidelijke Nederlandse commitboodschap.
