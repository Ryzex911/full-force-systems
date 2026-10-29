<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WebshopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Publieke pagina's
|--------------------------------------------------------------------------
*/

Route::get('/', HomeController::class)->name('home');
Route::get('/diensten', [ServiceController::class, 'index'])->name('diensten');
Route::get('/diensten/{slug}', [ServiceController::class, 'show'])->name('diensten.show');
Route::get('/pakketten', PackageController::class)->name('pakketten');
Route::get('/webshop', [WebshopController::class, 'index'])->name('webshop');
Route::get('/projecten', ProjectController::class)->name('projecten');
Route::get('/over-ons', AboutController::class)->name('over-ons');

// Contact en offerte: het formulier tonen en versturen (max. 5 keer per minuut, tegen spam)
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');

/*
|--------------------------------------------------------------------------
| Juridische pagina's
|--------------------------------------------------------------------------
*/

Route::prefix('juridisch')
    ->name('legal.')
    ->group(function () {
        // Overzicht
        Route::view('/', 'legal.index')->name('index');

        // Alle juridische pagina's: url => naam (route legal.privacy enz.)
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
            Route::view('/'.$url, 'legal.page', ['pageKey' => $key])->name($key);
        }
    });

/*
|--------------------------------------------------------------------------
| Account (Laravel Breeze). Inloggen, registreren enz. staan in routes/auth.php.
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
