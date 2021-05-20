<?php

namespace App\Http\Controllers;

use App\Mail\AdsEarlyExpire;
use App\Models\Phone;
use App\Models\User;
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
        $this->sendNotification();
        return view('dashboard.index');
    }

    public function profil()
    {
        $this->sendNotification();
        $planId = auth()->user()->plan_user_id;
        $plan = \App\Models\PlanUser::where('id', '=', $planId)->first();
        return view('dashboard.profil', compact('plan'));
    }

    public function settings()
    {
        return view('dashboard.edit');
    }

    public function updateUser(Request $request)
    {
        $user = \auth()->user();
        //TODO:check si ca a change
        if ($request->name != $user->getOriginal('name')) {
            $request->validate([
                'name' => ['required', 'string', 'max:255', Rule::unique(User::class)]]);
        }elseif ($request->email != $user->getOriginal('email')){
            $request->validate([
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ]]);
        }elseif($request->password && $request->password != $user->getOriginal('password')){
            $request->validate([
                'password' => [
                    'min:8',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                ],
            ]);
        }
        $request->validate([
            'picture' => ['image:jpg,jpeg,png,svg'],
        ]);

        $user->name = $request->name;

        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->slug = Str::slug($request->name);
        $user->phones()->delete();
        $user->phones()->saveMany([
            new Phone(['number' => $request->phoneone]),
            new Phone(['number' => $request->phonetwo]),
            new Phone(['number' => $request->phonethree]),
        ]);
        $user->update();
        if ($user->wasChanged()) {
            Session::flash('success-update', 'Votre profil a bien été mis a jour!');
        }
        return redirect(route('dashboard.profil'));

    }

    public function ads()
    {
        return view('dashboard.index');
    }

    protected function sendNotification()
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
                $adsExpire->end_plan = null;
                $adsExpire->plan_announcement_id = null;
                $adsExpire->update();
            }
        }
        if (auth()->user()->end_plan < Carbon::now()->subDay(1)) {
            if (auth()->user()->sending_time_expire == 0) {
                auth()->user()->sending_time_expire = 1;
                auth()->user()->end_plan = null;
                auth()->user()->save();
                Mail::to(env('MAIL_FROM_ADDRESS'))
                    ->send(new AdsEarlyExpire(auth()->user()));
                Session::flash('expire', 'Attention, votre compte va expirer dans un jour !');
            }
        }
        if (auth()->user()->end_plan <= Carbon::now()) {
            auth()->user()->is_payed = 0;
            auth()->user()->end_plan = null;
            auth()->user()->plan_user_id = null;
            auth()->user()->update();
        }
    }
}
