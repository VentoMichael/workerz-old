<?php

namespace App\Http\Controllers;

use App\Models\CatchPhraseUser;
use App\Models\Category;
use App\Models\PlanUser;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $workerz = User::withLikes()->Independent()->Payed()->NoBan()->with('locations')->orderBy('plan_user_id','DESC')->orderBy('created_at', 'DESC')->paginate(4)->onEachSide(0);
        $categories = Category::with(([
            'users' => function ($q) {
                $q->Independent()->Payed()->NoBan();
            }
        ]))->withCount("users")->get()->sortBy('name');
        $regions = Province::with(([
            'users' => function ($q) {
                $q->Independent()->Payed()->NoBan();
            }
        ]))->withCount("users")->get()->sortBy('name');
        return view('workerz.index', compact('workerz', 'categories', 'regions'));
    }

    public function show(User $worker)
    {
        $worker = User::withLikes()->Independent()->Payed()->NoBan()->with('startDate', 'phones','locations')->get()->where('id', '=', $worker->id)->first();
        $randomUsers = User::Independent()->Payed()->NoBan()->orderBy('role_id', 'DESC')->withLikes()->limit(2)->inRandomOrder()->get();
        $randomPhrasing = CatchPhraseUser::all()->random();
        return view('workerz.show', compact('worker', 'randomPhrasing', 'randomUsers'));
    }

    public function payed(Request $request,User $user)
    {
        $id = Auth::id();
        $user = User::where('id','=',$id)->first();
        if (request()->has('is_payed')){
            $user->is_payed = 1;
            $user->update($request);
        }
        //dd($request,$user);
        $plan = PlanUser::where('id','=',$request->user()->plan_user_id)->get();
        Session::flash('success-inscription', 'Votre inscription à été un succés ! Il suffit de terminer le paiement et votre entreprise sera visible.');
        return view('users.payed',compact('plan'));
    }
}
