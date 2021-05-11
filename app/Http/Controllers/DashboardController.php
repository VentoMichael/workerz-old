<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }
    public function settings(){
        return view('dashboard.index');
    }
    public function ads(){
        return view('dashboard.index');
    }
}
