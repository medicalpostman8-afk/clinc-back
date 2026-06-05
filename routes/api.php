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
use App\Http\Controllers\Api\AvailabilityController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\MedicineController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\PrescriptionController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\VisitController;
use App\Http\Controllers\Api\MedicalResultController;
use App\Http\Controllers\Api\EmergencyRequestController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\Auth\ProfilePatientController;
use App\Http\Controllers\Api\Auth\RegisteredPatientController;
use App\Http\Controllers\Api\BookingInfoController;
use App\Http\Controllers\Api\PatientReservationController;
use App\Http\Controllers\Api\PatientBlogsController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\PatientPrescriptionController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {

    // Auth routes start

    Route::middleware('guest')->group(function () {

        Route::post('/register', [RegisteredUserController::class, 'store'])
            ->name('register');

        Route::post('/patien-register', [RegisteredPatientController::class, 'store'])
            ->name('patien_register');

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

        // patient routes
        Route::get('home', [HomeController::class, 'index']);

        Route::get('profile', [ProfilePatientController::class, 'show']);

        Route::post('profile/update', [ProfilePatientController::class, 'update']);

        Route::apiResource('patient-reservations', PatientReservationController::class)
            ->only(['index', 'store', 'show'])
            ->parameters([
                'patient-reservations' => 'reservation',
            ]);

        Route::post('patient-reservations/{reservation}/cancel', [PatientReservationController::class, 'cancel']);

        Route::apiResource('visits', VisitController::class)
            ->only(['index', 'show']);

        Route::apiResource('patient-prescriptions', PatientPrescriptionController::class)
            ->only(['index', 'show', 'store']);

        Route::apiResource('medical-results', MedicalResultController::class)
            ->only(['index', 'store', 'show']);

        Route::post('medical-results/{medicalResult}/files', [MedicalResultController::class, 'uploadFiles']);

        Route::delete('medical-results/files/{media}', [MedicalResultController::class, 'deleteFile']);

        Route::apiResource('emergency-requests', EmergencyRequestController::class)
            ->only(['index', 'store', 'show']);

        Route::post('emergency-requests/{emergencyRequest}/cancel', [EmergencyRequestController::class, 'cancel']);

        Route::apiResource('invoices', InvoiceController::class)->only(['index', 'show']);
        //end patient routes

        //Reservation Routes start
        Route::apiResource('reservations', ReservationController::class)
            ->only('index', 'show', 'store', 'destroy');

        Route::post('reservations/update/{reservation}', [ReservationController::class, 'update']);

        Route::post('reservations/{reservation}/status', [ReservationController::class, 'updateStatus']);

        Route::get('reservations-day/day', [ReservationController::class, 'dayReservations']);

        Route::apiResource('booking-infos', BookingInfoController::class);

        Route::post('booking-infos-update/{bookingInfo}', [BookingInfoController::class, 'update']);
        //Reservation Routes end

        //Patient Routes start
        Route::apiResource('patients', PatientController::class)
            ->only('index', 'show', 'store', 'destroy');

        Route::post('patients/update/{patient}', [PatientController::class, 'update']);

        Route::post('visits', [VisitController::class, 'store']);

        Route::get('patients/{patient}/visits', [VisitController::class, 'patientVisits']);

        Route::get('medicines', [MedicineController::class, 'index']);

        Route::get('/patients/{patient}/history', [PatientController::class, 'history']);


        Route::post('patient-reservations/{reservation}/pay', [PatientReservationController::class, 'pay']);
        //patient end route

        //prescription routes start
        Route::post('prescriptions', [PrescriptionController::class, 'store']);

        Route::get(
            'patients/{patient}/prescriptions',
            [PrescriptionController::class, 'patientPrescriptions']
        );

        Route::delete(
            'prescriptions/{prescription}',
            [PrescriptionController::class, 'destroy']
        );

        Route::get('prescriptions/search', [PrescriptionController::class, 'search']);
        //prescription routes end

        //Invoice routes start
        Route::get('/invoices', [InvoiceController::class, 'index']);

        Route::get('/invoices/{reservation}', [InvoiceController::class, 'show']);
        //Invoice routes end

        // Banners requests routes start
        Route::apiResource('/banners', BannerController::class)
            ->only('index', 'store', 'destroy', 'show');

        Route::post('edit-banner/{banner}', [BannerController::class, 'update']);
        // Banners requests routes end

        //Blogs Routes start
        Route::apiResource('blogs', BlogController::class)
            ->only('index', 'store', 'destroy');

        Route::post('edit-blog/{blog}', [BlogController::class, 'update']);
        //Blogs Routes End

        //Avalibilty Routes Strat
        Route::get('/availabilities', [AvailabilityController::class, 'index']);

        Route::post('/availabilities', [AvailabilityController::class, 'store']);

        Route::delete('/availabilities/{id}', [AvailabilityController::class, 'destroy']);
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


    Route::get('settings', [SettingController::class, 'index']);
    Route::get('patient-blogs', [PatientBlogsController::class, 'index']);
    Route::get('patient-blogs/{blog}', [PatientBlogsController::class, 'show']);
    Route::get('medicines', [MedicineController::class, 'index']);
    Route::get('medicines/{medicine}', [MedicineController::class, 'show']);


    // Contact requests routes start
    Route::apiResource('/contact-requests', ContactController::class)
        ->only('store');
    // Contact requests routes end

});


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
