<?php

namespace App\Http\Controllers;

use App\Models\CatchPhraseUser;
use App\Models\Category;
use App\Models\Like;
use App\Models\Loves;
use App\Models\PlanUser;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function plans()
    {
        $plans = PlanUser::all();
        return view('users.plans', compact('plans'));
    }

    public function registration_type()
    {
        $plan = request('plan_user_id');
        return view('auth.registration_type', compact('plan'));
    }

    public function index()
    {
        // LISTER PAR ROLE_ID
        $workerz = User::Independent()->NoBan()->with('startDate', 'phones','provinces')->orderBy('role_id',
            'ASC')->orderBy('created_at', 'ASC')->orderBy('name', 'ASC')->paginate(4)->onEachSide(0);
        $categories = Category::with(([
            'users' => function ($q) {
                $q->Independent();
            }
        ]))->withCount("users")->get()->sortBy('name');
        $wo = User::Independent()->NoBan()->with('startDate', 'phones','provinces')->orderBy('role_id',
            'ASC')->orderBy('created_at', 'ASC')->orderBy('name', 'ASC');
        $wo->provinces;
        dd($wo);
        $regions = Province::with(([
            'users' => function ($q) {
                $q->Independent();
            }
        ]))->withCount("users")->withCount("users")->get()->sortBy('name');
        return view('workerz.index', compact('wo','workerz', 'categories', 'regions'));
    }

    public function show(User $worker)
    {
        $phone = $worker->load('phones');
        $worker->load('startDate','provinces');
        $randomUsers = User::Independent()->orderBy('role_id', 'DESC')->limit(2)->inRandomOrder()->get();
        $randomPhrasing = CatchPhraseUser::all()->random();
        return view('workerz.show', compact('worker', 'phone', 'randomPhrasing', 'randomUsers'));
    }

    public function payed(PlanUser $plan)
    {
        $plan = PlanUser::where('id','=',request()->input('plan'))->get();
        return view('users.payed',compact('plan'));
    }
}
