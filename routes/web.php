<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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


// ADS VIEWS
Route::get('/announcements', [\App\Http\Controllers\AnnouncementController::class, 'index'])
    ->name('announcements');
Route::get('/announcements/{announcement}',
    [\App\Http\Controllers\AnnouncementController::class, 'show'])
    ->name('announcements.show')->middleware('adsroute');


// WORKERS VIEW
Route::get('/workers', [\App\Http\Controllers\UserController::class, 'index'])
    ->name('workers');
Route::get('/workers/{worker}',
    [\App\Http\Controllers\UserController::class, 'show'])
    ->name('workers.show')
    ->middleware('userroute');

Route::get('/register/plans', [\App\Http\Controllers\UserController::class, 'plans'])
    ->name('users.plans');
// INSCRIPTION
Route::prefix('')->middleware(['guest'])->group(function () {
    Route::get('/register/plans/registration_type',
        [\App\Http\Controllers\UserController::class, 'registration_type'])
        ->name('users.type')
    ->middleware('noplansuser');
});

Route::post('/register/payed', [\App\Http\Controllers\UserController::class, 'payedUser'])->name('users.paied');
Route::get('/register/payed', [\App\Http\Controllers\UserController::class, 'payed'])->name('users.payed')->middleware('checkpayed','auth');

Route::prefix('')->middleware(['auth','verified'])->group(function () {
    // DASHBOARD
    Route::get('/dashboard',
        [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('payeduser');

    //NOTIFICATIONS
    Route::get('/dashboard/notifications/{id}', [
        \App\Http\Controllers\UserNotificationController::class, 'show'
    ])->name('dashboard.notificationsShow')->middleware('payeduser');
    Route::get('/dashboard/notifications', [
        \App\Http\Controllers\UserNotificationController::class, 'index'
    ])->name('dashboard.notifications')->middleware('payeduser');

    //MESSAGES
    Route::post('/dashboard/messages/{user}',
        [\App\Http\Controllers\MessageController::class, 'store'])->name('messages.post');
    Route::get('/dashboard/messages',
        [\App\Http\Controllers\MessageController::class, 'index'])->name('dashboard.messages')->middleware('payeduser');
    Route::get('/dashboard/messages/{user}',
        [\App\Http\Controllers\MessageController::class, 'show'])->name('dashboard.messagesShow');
    Route::delete('/dashboard/messages/{user}/delete',
        [\App\Http\Controllers\MessageController::class, 'deleteConversations'])->name('delete.conversations');

    //ADS DRAFT DASHBOARD
    Route::get('/dashboard/ads/draft/{announcement}',
        [\App\Http\Controllers\DashboardController::class, 'showDraft'])->name('dashboard.ads.showDraft')->middleware('payedads');

    Route::get('/dashboard/ads/draft/{announcement}/edit',
        [\App\Http\Controllers\DashboardController::class, 'editAdsDraft'])->name('dashboard.ads.showDraftEdit')->middleware('payedads');
    Route::put('/dashboard/ads/draft/{announcement}',
        [\App\Http\Controllers\DashboardController::class, 'updateAds'])->name('dashboard.ads.showDraftUpdate')->middleware('payedads');

    //ADS DASHBOARD
    Route::get('/dashboard/ads',
        [\App\Http\Controllers\DashboardController::class, 'ads'])->name('dashboard.ads')->middleware('payedads','payeduser');
    Route::get('/dashboard/ads/{announcement}',
        [\App\Http\Controllers\DashboardController::class, 'show'])->name('dashboard.ads.show')->middleware('payedads');
    Route::get('/dashboard/ads/{announcement}/edit',
        [\App\Http\Controllers\DashboardController::class, 'editAds'])->name('update.ads.dashboard')->middleware('payedads');
    Route::put('/dashboard/ads/{announcement}',
        [\App\Http\Controllers\DashboardController::class, 'updateAds'])->name('store.ads.dashboard')->middleware('payedads');
    Route::delete('/dashboard/ads/delete/{announcement}',
        [\App\Http\Controllers\DashboardController::class, 'deleteAds'])->name('delete.ads.dashboard')->middleware('payedads');
    Route::delete('/dashboard/ads/draft/delete/{announcement}',
        [\App\Http\Controllers\DashboardController::class, 'deleteAds'])->name('delete.adsDraft.dashboard')->middleware('payedads');

    // PROFIL
    Route::get('/dashboard/profil', [
        \App\Http\Controllers\DashboardController::class, 'profil'
    ])->name('dashboard.profil')->middleware('payeduser');
    Route::get('/plans', [\App\Http\Controllers\UserController::class, 'plansAlreadyUser'])
        ->name('usersAlready.plans');
    Route::get('/dashboard/profil/edit', [
        \App\Http\Controllers\DashboardController::class, 'settings'
    ])->name('dashboard.profil.edit')->middleware('payeduser');
    Route::put('/dashboard/profil/edit', [\App\Http\Controllers\DashboardController::class, 'updateUser'])->name('dashboard.update');

    // WORKERS
    Route::post('/workers/{worker}/like', [\App\Http\Controllers\UserLikeController::class, 'store']);
    Route::delete('/workers/{worker}/like', [\App\Http\Controllers\UserLikeController::class, 'delete']);

    // ADS CREATING
    Route::get('/announcement/plans',
        [\App\Http\Controllers\AnnouncementController::class, 'plans'])
        ->name('announcements.plans');
    Route::post('/announcements/{announcement}/like',
        [\App\Http\Controllers\AnnouncementLikeController::class, 'store']);
    Route::delete('/announcements/{announcement}/like',
        [\App\Http\Controllers\AnnouncementLikeController::class, 'delete']);
    Route::post('/announcement/create',
        [\App\Http\Controllers\AnnouncementController::class, 'store'])
        ->middleware('noplansads')
        ->name('announcements.store');
    Route::get('/announcement/create',
        [\App\Http\Controllers\AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcement/payed',
        [\App\Http\Controllers\AnnouncementController::class, 'payedAds'])->name('announcements.paied');
    Route::get('/announcement/payed', [\App\Http\Controllers\AnnouncementController::class, 'payed'])->name('announcements.payed');

});


// POLICY
Route::get('/conditions', function () {
    if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
    return view('conditions.index',compact('notificationsReaded'));
})->name('conditions');
Route::get('/policy', function () {
    if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
    return view('policy.index',compact('notificationsReaded'));
})->name('policy');

// ABOUT
Route::get('/about', function () {
    if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
    return view('about.index',compact('notificationsReaded'));
})->name('about');

// CONTACT
Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'create'])
    ->name('contact');
