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
            if ($adsExpire->end_plan > Carbon::now()->subDay(1)){
                if ($adsExpire->sending_time_expire == 0){
                    $adsExpire->sending_time_expire = 1;
                    $adsExpire->update();
                    Mail::to(env('MAIL_FROM_ADDRESS'))
                        ->send(new AdsEarlyExpire($adsExpire));
                    Session::flash('expireAds', 'Attention, une de vos annonce va bientôt expirer !');
                }
            }
            if ($adsExpire->end_plan >= Carbon::now()) {
                $adsExpire->is_draft = 1;
                $adsExpire->plan_announcement_id = null;
                $adsExpire->save();
            }
        }
        return view('dashboard.index');
    }
    public function settings(){
        return view('dashboard.index');
    }
    public function ads(){
        return view('dashboard.index');
    }
}
