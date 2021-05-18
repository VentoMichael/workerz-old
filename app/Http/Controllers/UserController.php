<?php

namespace App\Http\Controllers;

use App\Models\CatchPhraseUser;
use App\Models\Category;
use App\Models\PhysicalAdress;
use App\Models\PlanUser;
use App\Models\Province;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function plans()
    {
        $plans = PlanUser::all();
        $plan = request('plan');
        return view('users.plans', compact('plans', 'plan'));
    }

    public function registration_type()
    {
        $plan = request('plan');
        Session::put('plan', $plan);
        $type = \request('type');
        return view('auth.registration_type', compact('plan', 'type'));
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

    public function payed(Request $request, User $user)
    {
        $plan = PlanUser::where('id', '=', $request->user()->plan_user_id)->first();
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe_key = env('STRIPE_KEY');
        $amount = $plan->price;
        $amount *= 100;
        $amount = (int) $amount;
        $payment_intent = \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'EUR',
            'description' => 'Paiement pour un compte',
            'payment_method_types' => ['card'],
        ]);
        $intent = $payment_intent->client_secret;
        Session::flash('success-users',
            'Votre compte est presque finalisé, il sera opérationnel qu\'après reçu de votre payement !');
        return view('users.payed', compact('plan', 'intent', 'stripe_key'));
    }

    public function payedUser(Request $request, User $user)
    {
        $user = Auth::user();
        $user->is_payed = 1;
        $user->update();
        if ($user->plan_user_id == 2) {
            $days = 15;
        } else {
            $days = 30;
        }
        $trial = Carbon::now()->addDays($days);
        $user->end_plan = $trial;
        Session::flash('success-inscription',
            'Votre compte est désormais opérationnel, merci de votre confiance !');
        $user->update();
        //Mail::to(env('MAIL_FROM_ADDRESS'))
        //    ->send(new AdsCreated($announcement));
        //Mail::to(\auth()->user()->email)
        //    ->send(new AdsCreatedUser($announcement));
        return \redirect(route('dashboard.profil'));
    }

}
