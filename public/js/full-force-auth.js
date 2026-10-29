'use strict';

(function () {

    // ==========================================
    // 1. WACHTWOORD TONEN / VERBERGEN
    // ==========================================

    document.querySelectorAll('[data-password-toggle]').forEach(function (button) {

        button.addEventListener('click', function () {

            var input = document.getElementById(button.dataset.passwordToggle);

            if (!input) return;

            var reveal = input.type === 'password';

            input.type = reveal ? 'text' : 'password';

            button.setAttribute('aria-pressed', String(reveal));

            button.setAttribute(
                'aria-label',
                reveal ? 'Verberg wachtwoord' : 'Toon wachtwoord'
            );

        });

    });


    // ==========================================
    // 2. PARTICULIER / ZAKELIJK ACCOUNT
    // ==========================================

    var accountRadios = document.querySelectorAll('input[name="account_type"]');

    var companyContainer = document.getElementById('ff-company-field');

    var companyInput = document.getElementById('company_name');


    function updateAccountType() {

        if (!companyContainer || !companyInput) return;

        var selected = document.querySelector(
            'input[name="account_type"]:checked'
        );

        var business = !!selected && selected.value === 'zakelijk';

        // Bedrijfsnaam alleen tonen bij zakelijke accounts
        companyContainer.hidden = !business;

        // Bedrijfsnaam verplicht voor zakelijke accounts
        companyInput.required = business;

        // Voorkomen dat lege bedrijfsgegevens worden meegestuurd
        companyInput.disabled = !business;

    }


    accountRadios.forEach(function (radio) {

        radio.addEventListener('change', updateAccountType);

    });

    updateAccountType();


    // ==========================================
    // 3. WACHTWOORDSTERKTE CONTROLEREN
    // ==========================================

    document.querySelectorAll('[data-password-meter]').forEach(function (meter) {

        var input = document.getElementById(meter.dataset.passwordMeter);

        if (!input) return;

        var message = meter.querySelector('span');

        input.addEventListener('input', function () {

            var value = input.value;

            // Controleren welke tekens het wachtwoord bevat
            var classes = [
                /[a-z]/.test(value),
                /[A-Z]/.test(value),
                /[0-9]/.test(value),
                /[^a-zA-Z0-9]/.test(value)
            ].filter(Boolean).length;

            // Score berekenen
            var score = !value
                ? 0
                : value.length < 8
                    ? 1
                    : Math.min(
                        4,
                        1 + Math.min(3, classes - 1) + (value.length >= 12 ? 1 : 0)
                    );

            // Score opslaan voor CSS
            meter.dataset.score = String(score);

            // Bericht weergeven
            message.textContent = !value
                ? 'Gebruik minimaal 8 tekens'
                : value.length < 8
                    ? 'Minimaal 8 tekens nodig'
                    : ['', 'Zwak', 'Redelijk', 'Goed', 'Sterk'][score];

        });

    });


    // ==========================================
    // 4. DUBBEL VERSTUREN VOORKOMEN
    // ==========================================

    document.querySelectorAll('form[data-ff-form]').forEach(function (form) {

        form.addEventListener('submit', function () {

            var submit = form.querySelector('button[type="submit"]');

            if (!submit) return;

            // Knop tijdelijk uitschakelen
            submit.disabled = true;

            // Aangeven dat het formulier wordt verwerkt
            submit.setAttribute('aria-busy', 'true');

            // Knop opnieuw activeren bij een netwerkprobleem
            setTimeout(function () {

                submit.disabled = false;

                submit.removeAttribute('aria-busy');

            }, 12000);

        });

    });

})();
