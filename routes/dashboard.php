<?php

use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\OverviewController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->group(function () {
    Route::middleware(['auth'])->group(function () {

        Route::name('dashboard.')->group(function () {

            // Overview route
            Route::get('/', OverviewController::class)
                ->name('overview');

            // Settings routes start
            Route::prefix('settings')->group(function () {
                Route::name('settings.')->group(function () {

                    Route::get('/', [SettingsController::class, 'index'])
                        ->name('index');

                    Route::put('/basic-information', [SettingsController::class, 'update_basic_information'])
                        ->name('update_basic_information');

                    Route::put('/social-links', [SettingsController::class, 'update_social_links'])
                        ->name('update_social_links');

                    Route::put('/social-landing-page', [SettingsController::class, 'update_landing_page'])
                        ->name('update_landing_page');

                    Route::get('/{page}', [SettingsController::class, 'edit_default_page'])
                        ->name('edit_default_page');

                    Route::put('/{page}', [SettingsController::class, 'update_default_page'])
                        ->name('update_default_page');
                });
            });
            // Settings routes end

            // Page routes
            Route::resource('/pages', PageController::class)
                ->except(['show', 'destroy']);

            // Banner routes
            Route::resource('/banners', BannerController::class)
                ->except(['destroy']);

            // User routes
            Route::resource('/users', UserController::class)
                ->except(['destroy']);

            // Role routes
            Route::get('/roles', [RoleController::class, 'index'])
                ->name('roles.index');

            // Contact request routes
            Route::get('/contact-requests', [ContactController::class, 'index'])
                ->name('contacts.index');
        });
    });
});
