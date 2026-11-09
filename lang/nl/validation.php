<?php

/*
| Nederlandse foutmeldingen voor formulieren (o.a. inloggen, registreren, gegevens en wachtwoord wijzigen).
| Alleen de regels die de site gebruikt; voor andere regels valt Laravel terug op het Engels (fallback_locale).
| Het offerteformulier en de winkelwagen hebben hun eigen meldingen in de Form Request (QuoteRequest, CartItemRequest).
*/
return [
    'accepted' => ':Attribute moet geaccepteerd worden.',
    'confirmed' => 'De twee wachtwoorden zijn niet hetzelfde.',
    'current_password' => 'Het wachtwoord klopt niet.',
    'email' => 'Vul een geldig e-mailadres in.',
    'in' => 'Maak een geldige keuze.',
    'integer' => ':Attribute moet een heel getal zijn.',
    'lowercase' => ':Attribute mag alleen kleine letters bevatten.',
    'max' => [
        'numeric' => ':Attribute mag niet hoger zijn dan :max.',
        'string' => ':Attribute mag niet langer zijn dan :max tekens.',
    ],
    'min' => [
        'numeric' => ':Attribute moet minstens :min zijn.',
        'string' => ':Attribute moet minstens :min tekens lang zijn.',
    ],
    'password' => [
        'letters' => ':Attribute moet minstens één letter bevatten.',
        'mixed' => ':Attribute moet minstens één hoofdletter en één kleine letter bevatten.',
        'numbers' => ':Attribute moet minstens één cijfer bevatten.',
        'symbols' => ':Attribute moet minstens één leesteken bevatten.',
        'uncompromised' => 'Dit wachtwoord is gelekt bij een datalek. Kies een ander wachtwoord.',
    ],
    'required' => 'Vul :attribute in.',
    'required_if' => 'Vul :attribute in.',
    'string' => ':Attribute moet tekst zijn.',
    'unique' => ':Attribute is al in gebruik.',

    // Zo heten de velden in de meldingen ("Vul uw e-mailadres in.")
    'attributes' => [
        'name' => 'uw naam',
        'email' => 'uw e-mailadres',
        'password' => 'het wachtwoord',
        'current_password' => 'uw huidige wachtwoord',
        'password_confirmation' => 'het herhaalde wachtwoord',
        'company_name' => 'de naam van uw bedrijf',
        'account_type' => 'het soort klant',
    ],
];
