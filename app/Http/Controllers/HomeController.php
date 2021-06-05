<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        \request()->session()->forget('newsletter');
        $categories = Category::with(['users'=>function($q){
            $q->NoBan()->Payed()->Independent()->withCount('categoryUser');
        }])->get()->sortByDesc(function($categorie)
        {
            return $categorie->users->count();
        })->take(5);
        return view('home.index', compact('categories'));
    }
}
