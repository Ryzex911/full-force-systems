/*
 | Kleine stukjes gedrag voor de hele site:
 |  1. Wisselen tussen donker en licht thema
 |  2. Mobiel menu openen en sluiten (ook met Escape)
 |  3. Keuze particulier / zakelijk onthouden en overal gelijk houden
 |  4. Webshopfilters direct toepassen
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
    const zetMenu = (open) => {
        mobielMenu.classList.toggle('hidden', !open);
        menuKnop.setAttribute('aria-expanded', String(open));
        menuKnop.setAttribute('aria-label', open ? 'Menu sluiten' : 'Menu openen');
    };

    menuKnop.addEventListener('click', () => zetMenu(mobielMenu.classList.contains('hidden')));

    // Sluit het menu als je op een link in het menu klikt.
    mobielMenu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => zetMenu(false));
    });

    // Sluit het menu met de Escape-toets en zet de focus terug op de menuknop.
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !mobielMenu.classList.contains('hidden')) {
            zetMenu(false);
            menuKnop.focus();
        }
    });
}

// 3. Particulier / zakelijk ------------------------------------------------
// Overal dezelfde keuze:
//  - de knoppen in de header (data-klanttype="particulier" of "zakelijk")
//  - links die de keuze vastzetten, zoals "Mijn bedrijf" in de hero (data-kies-klant="zakelijk")
//  - de keuze in het offerteformulier (input name="klanttype")
function kiesKlanttype(type) {
    document.querySelectorAll('[data-klanttype]').forEach((knop) => {
        knop.setAttribute('aria-pressed', String(knop.dataset.klanttype === type));
    });

    document.querySelectorAll('input[name="klanttype"]').forEach((keuze) => {
        keuze.checked = keuze.value === type;
    });

    // Ook op <html>, zodat CSS (de variant zakelijk:) de keuze kan gebruiken.
    document.documentElement.dataset.klant = type;
}

function kiesEnBewaar(type) {
    kiesKlanttype(type);
    bewaar('ffs-klanttype', type);
}

document.querySelectorAll('[data-klanttype]').forEach((knop) => {
    knop.addEventListener('click', () => kiesEnBewaar(knop.dataset.klanttype));
});

document.querySelectorAll('[data-kies-klant]').forEach((link) => {
    link.addEventListener('click', () => kiesEnBewaar(link.dataset.kiesKlant));
});

document.querySelectorAll('input[name="klanttype"]').forEach((keuze) => {
    keuze.addEventListener('change', () => kiesEnBewaar(keuze.value));
});

// Staat de keuze in het formulier al vast (uit de link, bijv. ?klant=zakelijk, of na een fout),
// dan volgt de header het formulier. Anders geldt de bewaarde keuze.
const vasteKeuze = document.querySelector('[data-klant-vast]')?.dataset.klantVast;

if (vasteKeuze) {
    kiesEnBewaar(vasteKeuze);
} else {
    kiesKlanttype(lees('ffs-klanttype') || 'particulier');
}

// 4. Webshopfilters ----------------------------------------------------------
// Een formulier met data-auto-filter (de webshop) wordt meteen verstuurd als je een vinkje, de sortering of
// een prijs verandert. Zoeken gaat met Enter. Zonder JavaScript werkt alles ook, met de knop "Filters toepassen";
// die knop (data-zonder-js) verbergen we hier, omdat hij met JavaScript niet nodig is.
document.querySelectorAll('form[data-auto-filter]').forEach((formulier) => {
    formulier.querySelectorAll('[data-zonder-js]').forEach((element) => {
        element.hidden = true;
    });

    formulier.addEventListener('change', (event) => {
        if (event.target.matches('select, input[type="checkbox"], input[type="number"]')) {
            formulier.requestSubmit();
        }
    });

    // Lege velden niet meesturen, zodat de url kort en leesbaar blijft (/webshop?zoek=camera in plaats van ...&prijs_van=&prijs_tot=).
    formulier.addEventListener('formdata', (event) => {
        for (const [naam, waarde] of [...event.formData.entries()]) {
            if (waarde === '') {
                event.formData.delete(naam);
            }
        }
    });
});
