<?php

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

Route::get('/', function () {
    $users = \App\Models\User::with('phones')->get();
    $categories = \App\Models\Category::orderBy('name')->get();
    return view('home.index',compact('users','categories'));
});

Route::get('/announcements', [\App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements');

Route::get('/announcements/create',[\App\Http\Controllers\AnnouncementController::class, 'create'])->name('announcements.create');




Route::get('/workerz', function () {
    return view('workerz.index');
})->name('workerz');

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





