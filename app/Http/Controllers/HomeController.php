<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::orderBy('name', 'ASC')->get()->sortByDesc(function ($categories
        ) {
            return $categories->users->count();
        })->take(5);
        $workerz = User::Independent()
            ->Payed()
            ->NoBan()
            ->inRandomOrder()
            ->first();
        return view('home.index', compact('categories', 'workerz'));
    }
}
