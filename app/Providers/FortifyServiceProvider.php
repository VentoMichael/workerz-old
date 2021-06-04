<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Category;
use App\Models\Province;
use App\Models\StartDate;
use App\Models\StartDateUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Symfony\Component\Console\Input\Input;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::loginView(function () {
            return view('auth.login')->with('success-inscription', 'Connexion réussie !');
        });
        Fortify::registerView(function (Request $request) {
            $disponibilities = StartDate::all()->sortBy('id');
            $regions = Province::all()->sortBy('name');
            $categories = Category::all()->sortBy('name');
            $plan = Session::get('plan');
            $type = $request->type;
            Session::put('type',$type);
            $type = Session::get('type');
            if ($request->old('type') == null && $request->type == null){
                return redirect(route('users.plans'))->with('errors','Oops, il y a eu un souci, veuillez réessayer dans quelques instants.');
            }
            return view('auth.register',
                compact('plan', 'type', 'disponibilities', 'regions', 'categories', 'request'));
        });
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });
        Fortify::resetPasswordView(function () {
            return view('auth.reset-password');
        });
        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        RateLimiter::for("login", function () {
            Limit::perMinute(50);
        });

    }
}
