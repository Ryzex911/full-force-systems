<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/diensten', [ServiceController::class, 'index'])->name('diensten');
Route::get('/pakketten', PackageController::class)->name('pakketten');
Route::get('/over-ons', AboutController::class)->name('over-ons');

// Contact en offerte: het formulier tonen en versturen (max. 5 keer per minuut, tegen spam)
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');
