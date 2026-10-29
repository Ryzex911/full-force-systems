<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Full Force Systems - Juridische pagina's
|--------------------------------------------------------------------------
*/

Route::prefix('juridisch')
    ->name('legal.')
    ->group(function () {

        // Overzicht
        Route::view('/', 'legal.index')
            ->name('index');

        // Alle juridische pagina's
        $legalPages = [
            'privacyverklaring' => 'privacy',
            'algemene-voorwaarden' => 'terms',
            'cookiebeleid' => 'cookies',
            'retourbeleid' => 'returns',
            'verzendbeleid' => 'shipping',
            'garantie' => 'warranty',
            'klachtenprocedure' => 'complaints',
        ];

        foreach ($legalPages as $url => $key) {

            Route::view(
                '/' . $url,
                'legal.page',
                ['pageKey' => $key]
            )->name($key);

        }
    });


