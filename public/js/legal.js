'use strict';

/*
|--------------------------------------------------------------------------
| Full Force Systems - Theme Manager
|--------------------------------------------------------------------------
|
| Ondersteunt:
| - Light mode
| - Dark mode
| - Systeemvoorkeur
| - LocalStorage
| - Toegankelijkheid
|
*/

(function () {

    const STORAGE_KEY = 'ffs-theme';

    const root = document.documentElement;

    const buttons = document.querySelectorAll(
        '[data-theme-toggle]'
    );

    const systemTheme = window.matchMedia(
        '(prefers-color-scheme: dark)'
    );


    /*
    |--------------------------------------------------------------------------
    | Saved theme
    |--------------------------------------------------------------------------
    */

    function getSavedTheme() {

        try {
            return localStorage.getItem(STORAGE_KEY);
        } catch (error) {
            return null;
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Determine active theme
    |--------------------------------------------------------------------------
    */

    function getTheme() {

        const saved = getSavedTheme();

        if (saved === 'dark' || saved === 'light') {
            return saved;
        }

        return systemTheme.matches ? 'dark' : 'light';

    }


    /*
    |--------------------------------------------------------------------------
    | Apply theme
    |--------------------------------------------------------------------------
    */

    function applyTheme(theme, save = false) {

        root.dataset.theme = theme;

        const dark = theme === 'dark';

        buttons.forEach(function (button) {

            button.setAttribute(
                'aria-pressed',
                String(dark)
            );

            button.setAttribute(
                'aria-label',
                dark
                    ? 'Schakel naar lichte modus'
                    : 'Schakel naar donkere modus'
            );

            const label = button.querySelector(
                '[data-theme-label]'
            );

            if (label) {
                label.textContent = dark ? 'Licht' : 'Donker';
            }

        });


        if (save) {

            try {
                localStorage.setItem(STORAGE_KEY, theme);
            } catch (error) {
                // Thema blijft binnen de huidige pagina actief.
            }

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Toggle theme
    |--------------------------------------------------------------------------
    */

    function toggleTheme() {

        const current = root.dataset.theme;

        const next = current === 'dark'
            ? 'light'
            : 'dark';

        applyTheme(next, true);

    }


    /*
    |--------------------------------------------------------------------------
    | Initialize
    |--------------------------------------------------------------------------
    */

    applyTheme(getTheme());


    /*
    |--------------------------------------------------------------------------
    | Button events
    |--------------------------------------------------------------------------
    */

    buttons.forEach(function (button) {

        button.addEventListener(
            'click',
            toggleTheme
        );

    });


    /*
    |--------------------------------------------------------------------------
    | React to system theme changes
    |--------------------------------------------------------------------------
    */

    systemTheme.addEventListener(
        'change',
        function () {

            if (!getSavedTheme()) {
                applyTheme(getTheme());
            }

        }
    );

})();
