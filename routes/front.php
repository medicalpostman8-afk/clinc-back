<?php

use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\Front\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingController::class)->name('home');

Route::name('front.')->group(function () {

    // Page routes
    Route::get('/pages/{page}', PageController::class)
        ->name('pages.show');

    // Contact routes
    Route::get('/contact-us', [ContactController::class, 'index'])
        ->name('contacts.index');

    Route::post('/contact-us', [ContactController::class, 'store'])
        ->name('contacts.store');
});
