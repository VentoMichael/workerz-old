<?php

namespace App\Http\Controllers;

use App\Models\UserNotification;
use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = auth()->user()->notifications;
        return view('dashboard.notifications',compact('notifications'));
    }
    public function show()
    {
        $notifications = auth()->user()->notifications;
        return view('dashboard.showNotifications',compact('notifications'));
    }
}
