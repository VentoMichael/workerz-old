<?php

namespace App\Http\Controllers;

use App\Mail\AdsCreated;
use App\Mail\AdsEarlyExpire;
use App\Models\Phone;
use App\Models\User;
use App\Nova\PlanUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        foreach (auth()->user()->announcements as $adsExpire) {
            if ($adsExpire->end_plan < Carbon::now()->subDay(1)) {
                if ($adsExpire->sending_time_expire == 0) {
                    $adsExpire->sending_time_expire = 1;
                    $adsExpire->update();
                    Mail::to(auth()->user()->email)
                        ->send(new AdsEarlyExpire($adsExpire));
                    Session::flash('expire', 'Attention, une de vos annonce va expirer dans un jour !');
                }
            }
            if ($adsExpire->end_plan <= Carbon::now()) {
                $adsExpire->is_payed = 0;
                $adsExpire->plan_announcement_id = null;
                $adsExpire->update();
            }
        }
        if (auth()->user()->end_plan < Carbon::now()->subDay(1)) {
            if (auth()->user()->sending_time_expire == 0) {
                auth()->user()->sending_time_expire = 1;
                auth()->user()->update();
                Mail::to(env('MAIL_FROM_ADDRESS'))
                    ->send(new AdsEarlyExpire(auth()->user()));
                Session::flash('expire', 'Attention, votre compte va expirer dans un jour !');
            }
        }
        if (auth()->user()->end_plan <= Carbon::now()) {
            auth()->user()->is_payed = 0;
            auth()->user()->plan_user_id = 4;
            auth()->user()->update();
        }
        return view('dashboard.index');
    }

    public function profil()
    {
        $planId = auth()->user()->plan_user_id;
        $plan = \App\Models\PlanUser::where('id', '=', $planId)->first();
        $endDatePlan = auth()->user()->end_plan->locale('fr')->isoFormat('Do MMMM YYYY, H:mm');
        return view('dashboard.profil', compact('plan', 'endDatePlan'));
    }

    public function settings()
    {
        return view('dashboard.edit');
    }

    public function updateUser(Request $request)
    {
        $user = \auth()->user();
        //TODO:check si ca a change
        if ($user->wasChanged()) {
            $request->validate([
                'name' => ['required', 'string', 'max:255', Rule::unique(User::class)],
                'picture' => ['image:jpg,jpeg,png,svg'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => [
                    'min:8',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                ],
            ]);
            Session::flash('success-update', 'Votre profil a bien été mis a jour!');
        } else {
            Session::flash('success-update', 'Rien changé');
        }
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->slug = Str::slug($request->name);
        $phone = new Phone(['number' => $request->phone]);
        $user->phones()->save($phone);
        $user->save();
        return redirect(route('dashboard.profil'));

    }

    public function ads()
    {
        return view('dashboard.index');
    }
}
