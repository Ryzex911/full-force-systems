# Full Force Systems

Website, webshop en klantomgeving voor **Full Force Systems**.

Dit project wordt ontwikkeld als schoolproject door **Tawfik Alabed** en **Tamzid Mehedi**.

---

## Over het project

Full Force Systems is gespecialiseerd in technische beveiligingsoplossingen voor particuliere en zakelijke klanten.

De website moet bezoekers informeren over de diensten van Full Force Systems en daarnaast functioneren als webshop en klantomgeving.

De belangrijkste focus ligt op:

- Camerabeveiliging
- Alarmsystemen
- Toegangscontrole
- Video-intercom
- Onderhoud en service
- Beveiligingsproducten
- Offerteaanvragen
- Klantaccounts
- Bestellingen
- Adminbeheer

De applicatie wordt gebouwd met Laravel en MySQL.

---

## Opdrachtgever

**Full Force Systems**  
Handelsnaam van Full Force Security BV

Website:  
https://www.fullforcesystems.nl

E-mail:  
info@fullforcesystems.nl

Vestiging:  
Nijmegen

---

## Projectteam

| Naam | Rol |
|---|---|
| Tawfik Alabed | Software Developer |
| Tamzid Mehedi | Software Developer |

---

# Design

Het ontwerp van de website wordt gemaakt in Figma.

Figma:

https://www.figma.com/design/MTT4O8sElxO9Nwt2U6896z/Untitled?node-id=0-1&t=T6Kj6ARYrNQHgEKY-1

De gekozen huisstijl bestaat voornamelijk uit:

- Zwart
- Rood
- Wit
- Donkere en krachtige uitstraling
- Professioneel
- Zakelijk
- Overzichtelijk

De uiteindelijke Blade-implementatie moet zoveel mogelijk overeenkomen met het goedgekeurde Figma-ontwerp.

---

# Technologie

Voor het project gebruiken we:

### Backend

- PHP
- Laravel
- MySQL

### Frontend

- Blade
- Tailwind CSS
- Alpine.js
- Vite

### Authenticatie

- Laravel Breeze

### Development

- Composer
- NPM
- Git
- GitHub

---

# Functionaliteiten

## Publieke website

De website bevat uiteindelijk onder andere:

- Homepagina
- Over ons
- Diensten
- Projecten / referenties
- Contact
- Offerte aanvragen
- Webshop
- Productcategorieën
- Productpagina's
- Winkelmand
- Checkout
- Login
- Registreren

---

## Diensten

De belangrijkste diensten zijn:

### Camerabeveiliging

Advies, levering en installatie van camerabeveiligingssystemen voor woningen en bedrijfspanden.

### Alarmsystemen

Alarmoplossingen voor particuliere en zakelijke locaties.

### Toegangscontrole

Systemen waarmee toegang tot gebouwen of ruimtes beheerd kan worden.

### Video-intercom

Intercomsystemen waarmee bezoekers gecontroleerd toegang kunnen krijgen.

### Onderhoud en service

Onderhoud, ondersteuning en service voor bestaande beveiligingsinstallaties.

---

# Webshop

De webshop wordt voornamelijk gericht op particuliere klanten, maar zakelijke klanten kunnen ook producten bestellen.

Geplande productcategorieën zijn onder andere:

- Camera's
- Recorders / NVR / DVR
- Kabels en accessoires
- Alarmsystemen
- Toegangscontrole
- Intercom

Later kunnen meer categorieën worden toegevoegd.

---

# Klantaccount

Gebruikers moeten uiteindelijk beschikken over een eigen account.

Geplande functionaliteiten:

- Registreren
- Inloggen
- Uitloggen
- E-mailadres bevestigen
- Wachtwoord vergeten
- Wachtwoord resetten
- Remember me
- Adressen beheren
- Bestelgeschiedenis bekijken
- Offerteaanvragen bekijken
- Favorieten
- Accounttype particulier / zakelijk

---

# Offerteaanvragen

Bezoekers kunnen een offerte aanvragen.

Het formulier kan onder andere bevatten:

- Naam
- Bedrijfsnaam
- E-mailadres
- Telefoonnummer
- Postcode
- Plaats
- Particulier / zakelijk
- Gewenste dienst
- Producten
- Bericht / omschrijving

Offerteaanvragen worden:

1. opgeslagen in de database;
2. zichtbaar gemaakt in het adminpanel;
3. doorgestuurd naar Full Force Systems.

---

# Adminpanel

Bevoegde medewerkers krijgen toegang tot een apart adminpanel.

Geplande onderdelen:

- Dashboard
- Producten
- Productcategorieën
- Voorraad
- Bestellingen
- Klanten
- Contactaanvragen
- Offerteaanvragen
- Projecten / referenties
- Pagina-inhoud
- Medewerkers
- Rollen en rechten
- Statistieken

---

# Statistieken

Het adminpanel kan later statistieken tonen zoals:

- Meest bekeken producten
- Best verkochte producten
- Omzet
- Zoektermen
- Achtergelaten winkelmanden

Privacygevoelige tracking wordt alleen geïmplementeerd wanneer dit op een correcte en privacyvriendelijke manier mogelijk is.

---

# Betalingen

Geplande betaalmethodes:

- iDEAL
- Bankoverschrijving

De definitieve payment provider wordt later bepaald.

---

# E-mails

De applicatie moet automatische e-mails kunnen versturen voor onder andere:

- Accountbevestiging
- Wachtwoord reset
- Bestelling ontvangen
- Betaling gelukt
- Betaling mislukt
- Verzending
- Trackingcode
- Offerteaanvraag ontvangen

---

# Projectstructuur

Globaal gebruiken we de standaard Laravel-structuur:

```text
app/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/
│
├── Models/
├── Mail/
├── Services/
└── Providers/

database/
├── factories/
├── migrations/
└── seeders/

resources/
├── css/
├── js/
└── views/
    ├── auth/
    ├── components/
    ├── layouts/
    ├── pages/
    └── dashboard/

routes/
├── web.php
└── auth.php

tests/
├── Feature/
└── Unit/
```

De structuur kan tijdens de ontwikkeling worden uitgebreid.

---

# Installatie

## Vereisten

Zorg dat de volgende software geïnstalleerd is:

- PHP 8.2+
- Composer
- Node.js
- NPM
- MySQL
- Git

Voor Windows kan bijvoorbeeld Laragon worden gebruikt.

---

## Repository clonen

```bash
git clone https://github.com/Ryzex911/full-force-systems.git
```

Ga naar het project:

```bash
cd full-force-systems
```

---

## PHP dependencies installeren

```bash
composer install
```

---

## Environment bestand maken

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Of:

```bash
cp .env.example .env
```

---

## Application key genereren

```bash
php artisan key:generate
```

---

# Database

Maak lokaal een MySQL-database:

```text
full_force_systems
```

Configureer daarna `.env`.

Voorbeeld:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=full_force_systems
DB_USERNAME=root
DB_PASSWORD=
```

Voer daarna migrations uit:

```bash
php artisan migrate
```

---

# Frontend dependencies

Installeer NPM packages:

```bash
npm install
```

Start Vite:

```bash
npm run dev
```

Voor een production build:

```bash
npm run build
```

---

# Development server

Start Laravel:

```bash
php artisan serve
```

Standaard draait Laravel daarna op:

```text
http://127.0.0.1:8000
```

Tijdens development zijn meestal twee terminals nodig.

Terminal 1:

```bash
php artisan serve
```

Terminal 2:

```bash
npm run dev
```

---

# Authentication

Voor authenticatie gebruiken we Laravel Breeze met Blade.

Hiermee worden onder andere gerealiseerd:

- Login
- Registratie
- Logout
- Wachtwoord vergeten
- Wachtwoord reset
- E-mailverificatie basis
- Profile management

Breeze wordt geïnstalleerd in een aparte feature branch.

---

# Git workflow

We werken met:

```text
main
```

als stabiele hoofdbranch.

Nieuwe functionaliteiten worden ontwikkeld in aparte branches.

Voorbeelden:

```text
feature/authentication
feature/homepage
feature/main-layout
feature/services
feature/projects
feature/contact
feature/quote-request
feature/products
feature/cart
feature/checkout
feature/orders
feature/customer-dashboard
feature/admin-panel
```

---

## Nieuwe feature beginnen

Altijd eerst terug naar `main`:

```bash
git checkout main
git pull origin main
```

Maak daarna een branch:

```bash
git checkout -b feature/feature-naam
```

Voorbeeld:

```bash
git checkout -b feature/homepage
```

---

## Feature pushen

```bash
git add .
git commit -m "Add homepage"
git push -u origin feature/homepage
```

Daarna wordt op GitHub een Pull Request gemaakt:

```text
feature/homepage -> main
```

Pas na controle wordt de feature gemerged.

---

# Branch afspraken

Gebruik deze prefixes:

```text
feature/
fix/
docs/
refactor/
test/
```

Voorbeelden:

```text
feature/authentication
feature/products
fix/login-validation
docs/readme
refactor/product-controller
test/checkout
```

Gebruik:

```text
lowercase
```

en:

```text
kebab-case
```

Dus:

```text
feature/quote-request
```

en niet:

```text
Feature/Quote_Request
```

---

# Commit afspraken

Gebruik korte maar duidelijke commits.

Goed:

```text
Add login authentication
Add homepage hero section
Create products migration
Fix contact form validation
Update project README
```

Niet:

```text
update
fix
test
stuff
done
```

---

# Projectfasen

## Fase 1 - Structuur & design

- Sitemap
- User flows
- Wireframes
- Figma design
- Responsive ontwerp

## Fase 2 - Basiswebsite

- Laravel setup
- Database
- Algemene layout
- Homepagina
- Diensten
- Over ons
- Contact
- Projecten
- Offerteformulier
- Basis adminpanel

## Fase 3 - Accounts & webshop

- Registreren
- Login
- Klantdashboard
- Producten
- Categorieën
- Winkelmand
- Checkout
- Betalingen
- Bestellingen

## Fase 4 - Zakelijke functionaliteiten

- Zakelijke accounts
- Offerteworkflow
- Zakelijke bestellingen
- Factuurmogelijkheden

## Fase 5 - Statistieken

- Dashboard statistieken
- Productstatistieken
- Verkoopstatistieken
- Rapportages

## Fase 6 - Testen & livegang

- Functionele tests
- Responsive tests
- Browser tests
- Security checks
- SEO basis
- Contentcontrole
- Hosting
- Deployment
- Oplevering

---

# Security

Belangrijk:

Het `.env` bestand mag **nooit** naar GitHub worden gepusht.

Hierin kunnen gevoelige gegevens staan zoals:

- Databasewachtwoorden
- API keys
- Mail credentials
- Payment provider keys

Controleer daarom dat `.env` in `.gitignore` staat.

---

# Development status

Projectstatus:

```text
In development
```

Huidige fase:

```text
Realisatie
```

---

# Repository

GitHub:

https://github.com/Ryzex911/full-force-systems

---

# License

Dit project wordt ontwikkeld voor Full Force Systems als onderdeel van een schoolproject.

De broncode is niet bedoeld voor openbaar commercieel hergebruik zonder toestemming van het projectteam en de opdrachtgever.
