<?php

namespace App\Http\Controllers;

use App\Mail\AdsCreated;
use App\Mail\AdsEarlyExpire;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(){
        foreach (auth()->user()->announcements as $adsExpire){
            if ($adsExpire->end_plan < Carbon::now()->subDay(1)){
                if ($adsExpire->sending_time_expire == 0){
                    $adsExpire->sending_time_expire = 1;
                    $adsExpire->update();
                    Mail::to(env('MAIL_FROM_ADDRESS'))
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
        if (auth()->user()->end_plan < Carbon::now()->subDay(1)){
            if (auth()->user()->sending_time_expire == 0){
                auth()->user()->sending_time_expire = 1;
                auth()->user()->update();
                //Mail::to(env('MAIL_FROM_ADDRESS'))
                //    ->send(new AdsEarlyExpire(auth()->user()));
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
    public function settings(){
        return view('dashboard.profil');
    }
    public function ads(){
        return view('dashboard.index');
    }
}
