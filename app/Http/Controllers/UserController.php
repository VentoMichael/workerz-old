<?php

namespace App\Http\Controllers;

use App\Models\CatchPhraseUser;
use App\Models\Category;
use App\Models\PhysicalAdress;
use App\Models\PlanUser;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

        return view('workerz.index');
    }

    public function show(User $worker)
    {
        $worker = User::withLikes()->where('id', '=', $worker->id)->first();
        $randomUsers = User::Independent()->Payed()->NoBan()->orderBy('role_id',
            'DESC')->withLikes()->limit(2)->inRandomOrder()->get();
        $randomPhrasing = CatchPhraseUser::all()->random();
        return view('workerz.show', compact('worker', 'randomPhrasing', 'randomUsers'));
    }

    public function payedUser(Request $request, User $user)
    {
        if ($request->is_payed == 1){
            $user = Auth::user();
            $user->is_payed = 1;
            $user->update();
            return Redirect::route('dashboard')->with('success-inscription',
            'Votre inscription à été un succés, merci de votre confiance.');
        }
        Session::flash('errors',
            'Oops, il y a eu un souci, veuilliez réssayez.');
        return view('users.payed');
    }

    public function payed(Request $request, User $user)
    {
        $plan = PlanUser::where('id', '=', $request->user()->plan_user_id)->get();

        return view('users.payed', compact('plan'));
    }
}
