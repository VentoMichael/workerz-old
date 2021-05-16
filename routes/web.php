<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HOME PAGE
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home.index');


// NEWSLETTER
Route::post('/newsletter/store',
    [\App\Http\Controllers\NewsletterController::class, 'store'])->name('newsletter.store');


// ADS
Route::get('/announcements', [\App\Http\Controllers\AnnouncementController::class, 'index'])
    ->name('announcements');
Route::get('/announcements/{announcement}',
    [\App\Http\Controllers\AnnouncementController::class, 'show'])
    ->name('announcements.show')->middleware('adsroute');


// WORKERS
Route::get('/workerz', [\App\Http\Controllers\UserController::class, 'index'])
    ->name('workerz');
Route::get('/workerz/{worker}',
    [\App\Http\Controllers\UserController::class, 'show'])
    ->name('workerz.show')
    ->middleware('userroute');


// INSCRIPTION
Route::prefix('')->middleware(['guest'])->group(function () {
    Route::get('/register/plans', [\App\Http\Controllers\UserController::class, 'plans'])
        ->name('users.plans');
    Route::get('/register/plans/registration_type',
        [\App\Http\Controllers\UserController::class, 'registration_type'])
        ->name('users.type');
});
Route::get('/register/payed', [\App\Http\Controllers\UserController::class, 'payed']);

Route::prefix('')->middleware(['auth'])->group(function () {
    // DASHBOARD
    Route::get('/dashboard',
        [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('payeduser');
    Route::get('/dashboard/profile', [
        \App\Http\Controllers\DashboardController::class, 'settings'
    ])->name('dashboard/profile')->middleware('payeduser');
    Route::get('/dashboard/ads',
        [\App\Http\Controllers\DashboardController::class, 'ads'])->name('dashboard/ads')->middleware('payeduser');

    // WORKERS
    Route::post('/workerz/{worker}/like', [\App\Http\Controllers\UserLikeController::class, 'store']);
    Route::delete('/workerz/{worker}/like', [\App\Http\Controllers\UserLikeController::class, 'delete']);

    // ADS
    Route::get('/announcement/plans',
        [\App\Http\Controllers\AnnouncementController::class, 'plans'])
        ->name('announcements.plans');
    Route::post('/announcements/{announcement}/like',
        [\App\Http\Controllers\AnnouncementLikeController::class, 'store']);
    Route::delete('/announcements/{announcement}/like',
        [\App\Http\Controllers\AnnouncementLikeController::class, 'delete']);
    Route::post('/announcement/create',
        [\App\Http\Controllers\AnnouncementController::class, 'store'])
        ->name('announcements.store');
    Route::get('/announcement/create',
        [\App\Http\Controllers\AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcement/payed',
        [\App\Http\Controllers\AnnouncementController::class, 'payedAds'])
        ->name('announcements.payed');
    Route::get('/announcement/payed', [\App\Http\Controllers\AnnouncementController::class, 'payed'])
        ->name('announcements.payed');
});


// POLICY
Route::get('/conditions', function () {
    return view('conditions.index');
})->name('conditions');
Route::get('/policy', function () {
    return view('policy.index');
})->name('policy');

// ABOUT
Route::get('/about', function () {
    return view('about.index');
})->name('about');

// CONTACT
Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'create'])
    ->name('contact');



