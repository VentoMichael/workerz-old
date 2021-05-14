<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('users')->orderBy('users_count','DESC')->orderBy('name','ASC')->take(5)->get();
        return view('home.index', compact('categories'));
    }
}
