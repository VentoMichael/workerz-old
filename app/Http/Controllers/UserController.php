<?php

namespace App\Http\Controllers;

use App\Models\CatchPhraseUser;
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
        $workerz = User::Independent()->with('loves','startDateUser','phones')->orderBy('role_id', 'DESC')->orderBy('created_at', 'ASC')->orderBy('name', 'ASC')->paginate(4)->onEachSide(0);
        foreach($workerz as $worker){
            if (strlen($worker->description) > 60 && !isset($_GET['showmore'.$worker->id])) {
                $worker->description = substr($worker->description, 0, 60).'...';
            }}
        $categories = Category::with((['users' => function ($q) {
            $q->Independent();
        }]))->withCount("users")->get()->sortBy('name');

        $loves = Loves::with((['user' => function ($q) {
            $q->Independent();
        }]))->withCount("user")->get()->sortBy('name');

        $regions = Province::with((['users' => function ($q) {
            $q->Independent();
        }]))->withCount("users")->withCount("users")->get()->sortBy('name');

        return view('workerz.index',compact('workerz','categories','loves','regions'));
    }
    public function show(User $worker)
    {
        $phone = $worker->load('phones');
        $worker->load('startDateUser');
        $randomUsers = User::Independent()->orderBy('role_id', 'DESC')->limit(2)->inRandomOrder()->get();
        $randomPhrasing = CatchPhraseUser::all()->random();
        return view('workerz.show', compact('worker','phone','randomPhrasing','randomUsers'));
    }
}
