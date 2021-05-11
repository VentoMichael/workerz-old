<?php

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

Route::get('/', function () {
    $categories = \App\Models\Category::orderBy('name', 'ASC')->get()->sortByDesc(function ($categories
    ) {
        return $categories->users->count();
    })->take(5);
    $workerz = User::Independent()
        ->Payed()
        ->NoBan()
        ->inRandomOrder()
        ->first();
    return view('home.index', compact( 'categories', 'workerz'));
})->name('home.index');





Route::post('/newsletter/store',
    [\App\Http\Controllers\NewsletterController::class, 'store'])
    ->name('newsletter.store');





Route::get('/announcements', [\App\Http\Controllers\AnnouncementController::class, 'index'])
    ->name('announcements');

Route::get('/announcements/{announcement}',
    [\App\Http\Controllers\AnnouncementController::class, 'show'])
    ->name('announcements.show');





Route::get('/register/plans', [\App\Http\Controllers\UserController::class, 'plans'])
    ->name('users.plans');

Route::get('/register/plans/registration_type',
    [\App\Http\Controllers\UserController::class, 'registration_type'])
    ->name('users.type')->middleware('noplansuser');

Route::get('/register/payed', [\App\Http\Controllers\UserController::class, 'payed'])
    ->name('users.payed')->middleware('noplansuser');

Route::get('/workerz', [\App\Http\Controllers\UserController::class, 'index'])
    ->name('workerz');

Route::get('/workerz/{worker}',
    [\App\Http\Controllers\UserController::class, 'show'])
    ->name('workerz.show')
    ->middleware('userroute');

Route::post('/workerz/{worker}/like', [\App\Http\Controllers\UserLikeController::class, 'store']);

Route::delete('/workerz/{worker}/like', [\App\Http\Controllers\UserLikeController::class, 'delete']);





Route::prefix('')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/dashboard/profile', function () {
        return view('dashboard.index');
    })->name('dashboard/profile')->middleware('payeduser');

    Route::get('/dashboard/ads', function () {
        return view('dashboard.index');
    })->name('dashboard/ads')->middleware('payedads');

    Route::get('/announcement/plans',
        [\App\Http\Controllers\AnnouncementController::class, 'plans'])
        ->name('announcements.plans');
    Route::post('/announcements/{announcement}/like', [\App\Http\Controllers\AnnouncementLikeController::class, 'store']);
    Route::delete('/announcements/{announcement}/like',
        [\App\Http\Controllers\AnnouncementLikeController::class, 'delete']);
    Route::post('/announcement/',
        [\App\Http\Controllers\AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('/announcement/create',
        [\App\Http\Controllers\AnnouncementController::class, 'create'])->name('announcements.create');
    Route::get('/announcement/payed', [\App\Http\Controllers\AnnouncementController::class, 'payed'])
        ->name('announcements.payed');
});





Route::get('/conditions', function () {
    return view('conditions.index');
})->name('conditions');

Route::get('/policy', function () {
    return view('policy.index');
})->name('policy');




Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'create'])
    ->name('contact');





Route::get('/about', function () {
    return view('about.index');
})->name('about');
