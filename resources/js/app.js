/*
 | Kleine stukjes gedrag voor de hele site:
 |  1. Wisselen tussen donker en licht thema
 |  2. Mobiel menu openen en sluiten
 |  3. Keuze particulier / zakelijk onthouden
 */

/** Lees een waarde uit localStorage. Geeft null terug als opslag niet beschikbaar is. */
function lees(sleutel) {
    try {
        return localStorage.getItem(sleutel);
    } catch (fout) {
        return null;
    }
}

/** Bewaar een waarde in localStorage (mislukt stil in bijvoorbeeld een privévenster). */
function bewaar(sleutel, waarde) {
    try {
        localStorage.setItem(sleutel, waarde);
    } catch (fout) {
        // Niets doen: de site werkt ook zonder opslag.
    }
}

// 1. Thema -----------------------------------------------------------------
// Het thema staat als data-theme="dark" of data-theme="light" op <html>.
// De kleuren zelf staan in resources/css/app.css.
document.querySelectorAll('[data-thema-knop]').forEach((knop) => {
    knop.addEventListener('click', () => {
        const html = document.documentElement;
        const nieuwThema = html.dataset.theme === 'light' ? 'dark' : 'light';

        html.dataset.theme = nieuwThema;
        bewaar('ffs-thema', nieuwThema);
    });
});

// 2. Mobiel menu -----------------------------------------------------------
const menuKnop = document.querySelector('[data-menu-knop]');
const mobielMenu = document.getElementById('mobiel-menu');

if (menuKnop && mobielMenu) {
    menuKnop.addEventListener('click', () => {
        const isOpen = !mobielMenu.classList.toggle('hidden');

        menuKnop.setAttribute('aria-expanded', String(isOpen));
        menuKnop.setAttribute('aria-label', isOpen ? 'Menu sluiten' : 'Menu openen');
    });

    // Sluit het menu als je op een link in het menu klikt.
    mobielMenu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            mobielMenu.classList.add('hidden');
            menuKnop.setAttribute('aria-expanded', 'false');
            menuKnop.setAttribute('aria-label', 'Menu openen');
        });
    });
}

// 3. Particulier / zakelijk ------------------------------------------------
// De knoppen hebben data-klanttype="particulier" of data-klanttype="zakelijk".
function kiesKlanttype(type) {
    document.querySelectorAll('[data-klanttype]').forEach((knop) => {
        knop.setAttribute('aria-pressed', String(knop.dataset.klanttype === type));
    });

    // Ook op <html>, zodat CSS of andere scripts de keuze kunnen gebruiken.
    document.documentElement.dataset.klant = type;
}

document.querySelectorAll('[data-klanttype]').forEach((knop) => {
    knop.addEventListener('click', () => {
        kiesKlanttype(knop.dataset.klanttype);
        bewaar('ffs-klanttype', knop.dataset.klanttype);
    });
});

kiesKlanttype(lees('ffs-klanttype') || 'particulier');
