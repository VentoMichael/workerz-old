<?php

namespace App\Http\Controllers;

use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $notifications = auth()->user()->notifications;
        foreach ($notifications as $notification) {
            if($notification->read_at !== null && $notification->read_at <= Carbon::now()->subDays(7)){
                $notification->delete();
                return \redirect()->route('dashboard.notifications');
            };
        }
        return view('dashboard.notifications',compact('notifications'));
    }
    public function show($id)
    {
        $n = auth()->user()->notifications->where('id','=',$id)->first();
        $notifications = \auth()->user()->notifications;
        $notifReaded = auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        return view('dashboard.showNotifications',compact('notifications','notifReaded','n'));
    }
}
