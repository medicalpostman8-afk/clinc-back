<?php

use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Api\Auth\NewPasswordController;
use App\Http\Controllers\Api\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\Auth\RegisteredUserController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\Auth\ProfileController;
use App\Http\Controllers\Api\MedicineController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\VisitController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {

    // Auth routes start

    Route::middleware('guest')->group(function () {

        Route::post('/register', [RegisteredUserController::class, 'store'])
            ->name('register');

        Route::post('/login', [AuthenticatedSessionController::class, 'store'])
            ->name('login');

        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware(['throttle:6,1'])
            ->name('verification.send');

        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        // Profile routes start
        Route::prefix('profile')->group(function () {
            Route::name('profile.')->group(function () {

                Route::post('/update', [ProfileController::class, 'update'])
                    ->name('update');

                Route::put('/update-password', [ProfileController::class, 'update_password'])
                    ->name('update_password');

                Route::delete('/delete', [ProfileController::class, 'delete'])
                    ->name('delete');
            });
        });
        // Profile routes start

        //Reservation Routes start
        Route::apiResource('reservations', ReservationController::class)
            ->only('index', 'show', 'store', 'destory');

        Route::post('reservations/update/{reservation}', [ReservationController::class, 'update']);

        Route::post('reservations/{reservation}/status', [ReservationController::class, 'updateStatus']);

        Route::get('reservations-day/day', [ReservationController::class, 'dayReservations']);
        //Reservation Routes end

        //Patient Routes start
        Route::apiResource('patients', PatientController::class)
            ->only('index', 'show', 'store', 'destory');

        Route::post('patients/update/{patient}', [PatientController::class, 'update']);

        Route::post('visits', [VisitController::class, 'store']);

        Route::get('patients/{patient}/visits', [VisitController::class, 'patientVisits']);

        Route::get('medicines', [MedicineController::class, 'index']);
    });

    // Auth routes end

    // General routes start
    Route::prefix('general')->group(function () {
        Route::name('general.')->group(function () {
            Route::get('/default-pages/{page}', [GeneralController::class, 'show_default_page'])
                ->name('show_default_page');
        });
    });
    // General routes end

    // Banners requests routes start
    Route::apiResource('/banners', BannerController::class)
        ->only('index');
    // Banners requests routes end

    // Contact requests routes start
    Route::apiResource('/contact-requests', ContactController::class)
        ->only('store');
    // Contact requests routes end

});


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
