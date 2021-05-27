<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['users'=>function($q){
            $q->NoBan()->Payed()->withCount('categoryUser');
        }])->take(5)->get()->sortByDesc(function($categorie)
        {
            return $categorie->users->count();
        });
        return view('home.index', compact('categories'));
    }
}
