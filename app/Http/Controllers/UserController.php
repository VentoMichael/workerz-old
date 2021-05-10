<?php

namespace App\Http\Controllers;

use App\Models\CatchPhraseUser;
use App\Models\Category;
use App\Models\PlanUser;
use App\Models\Province;
use App\Models\User;
use App\Models\PlanAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $workerz = User::withLikes()->Independent()->Payed()->NoBan()->with('startDate', 'phones','locations')->orderBy('plan_user_id','DESC')->orderBy('created_at', 'DESC')->paginate(4)->onEachSide(0);
        $categories = Category::with(([
            'users' => function ($q) {
                $q->Independent();
            }
        ]))->withCount("users")->get()->sortBy('name');
        $regions = Province::with(([
            'users' => function ($q) {
                $q->Independent();
            }
        ]))->withCount("users")->withCount("users")->get()->sortBy('name');
        return view('workerz.index', compact('workerz', 'categories', 'regions'));
    }

    public function show(User $worker)
    {
        $worker = User::withLikes()->Independent()->Payed()->NoBan()->with('startDate', 'phones','locations')->get()->find($worker);;
        $randomUsers = User::Independent()->Payed()->NoBan()->orderBy('role_id', 'DESC')->withLikes()->limit(2)->inRandomOrder()->get();
        $randomPhrasing = CatchPhraseUser::all()->random();
        return view('workerz.show', compact('worker', 'randomPhrasing', 'randomUsers'));
    }

    public function payed(Request $request)
    {
        $plan = PlanUser::where('id','=',$request->user()->plan_user_id)->get();
        Session::flash('success-inscription', 'Votre inscription à été un succés ! Il suffit de terminer le paiement et votre entreprise sera visible.');
        return view('users.payed',compact('plan'));
    }
}
