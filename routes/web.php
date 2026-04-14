<?php

use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

Route::get('setlocale', LocaleController::class)->name('setlocale');

require __DIR__ . '/auth.php';
require __DIR__ . '/front.php';
require __DIR__ . '/dashboard.php';
