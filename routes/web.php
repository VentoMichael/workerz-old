<?php

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
    Session::flash('success', 'Here is your success message');
    return view('home.index',compact('users','categories'));
});

Route::get('/register/plans', [\App\Http\Controllers\UserController::class, 'plans'])->name('users.plans');

Route::get('/announcements', [\App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements');

Route::get('/announcements/plans', [\App\Http\Controllers\AnnouncementController::class, 'plans'])->name('announcements.plans');

Route::get('/announcements/{announcement}', [\App\Http\Controllers\AnnouncementController::class, 'show'])->name('announcements.show');

Route::get('/announcements/create',[\App\Http\Controllers\AnnouncementController::class, 'create'])->name('announcements.create');




Route::get('/workerz', function () {
    return view('workerz.index');
})->name('workerz');

Route::get('/workerz/{workerz}', function () {
    return view('workerz.show');
})->name('workerz.perso');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/conditions', function () {
    return view('conditions.index');
})->name('conditions');

Route::get('/policy', function () {
    return view('policy.index');
})->name('policy');

Route::get('/contact', function () {
    return view('contact.index');
})->name('contact');

Route::get('/about', function () {
    return view('about.index');
})->name('about');





