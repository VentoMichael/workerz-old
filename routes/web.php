<?php

use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    $users = \App\Models\User::with('phones')->get();
    $categories = \App\Models\Category::with('users')->orderBy('name','ASC')->get()->sortByDesc(function($categories)
    {
        return $categories->users->count();
    })->take(5);
    $workerz = User::Independent()
        ->inRandomOrder()
        ->first();
    Session::flash('success', 'Here is your success message');
    return view('home.index',compact('users','categories','workerz'));
});

Route::get('/register/plans', [\App\Http\Controllers\UserController::class, 'plans'])->name('users.plans');

Route::get('/announcements', [\App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements');

Route::get('/announcements/plans', [\App\Http\Controllers\AnnouncementController::class, 'plans'])->name('announcements.plans');

Route::get('/announcements/{announcement}', [\App\Http\Controllers\AnnouncementController::class, 'show'])->name('announcements.show');

Route::get('/announcements/create',[\App\Http\Controllers\AnnouncementController::class, 'create'])->name('announcements.create');


Route::get('/workerz', [\App\Http\Controllers\UserController::class, 'index'])->name('workerz');

Route::get('/workerz/{workerz}',[\App\Http\Controllers\UserController::class, 'show'])->name('workerz.show');


Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/conditions', function () {
    return view('conditions.index');
})->name('conditions');

Route::get('/policy', function () {
    return view('policy.index');
})->name('policy');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact',[\App\Http\Controllers\ContactController::class, 'create'])->name('contact');


Route::get('/about', function () {
    return view('about.index');
})->name('about');





