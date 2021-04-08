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

Route::get('/login', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth')->name('dashboardUser.index');

