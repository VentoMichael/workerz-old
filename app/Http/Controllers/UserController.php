<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryUser;
use App\Models\Loves;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function plans()
    {
        return view('users.plans');
    }
    public function index()
    {
        $workerz = User::Independent()->with('loves')->orderBy('role_id', 'DESC')->orderBy('created_at', 'DESC')->paginate(4)->onEachSide(0);
        foreach($workerz as $worker){
            if (strlen($worker->description) > 60 && !isset($_GET['showmore'.$worker->id])) {
                $worker->description = substr($worker->description, 0, 60).'...';
            }}
        $categories = Category::with((['users' => function ($q) {
            $q->Independent();
        }]))->withCount("users")->get()->sortBy('name');

        $regions = Province::with((['users' => function ($q) {
            $q->Independent();
        }]))->withCount("users")->withCount("users")->get()->sortBy('name');

        return view('workerz.index',compact('workerz','categories','regions'));
    }
    public function show(User $name)
    {
        return view('workerz.show', compact('name'));
    }
}
