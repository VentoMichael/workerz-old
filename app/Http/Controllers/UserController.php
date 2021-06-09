<?php

namespace App\Http\Controllers;

use App\Mail\NewUser;
use App\Mail\NewUserAdmin;
use App\Models\CatchPhraseUser;
use App\Models\PlanUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class UserController extends Controller
{
    public function plans()
    {
        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        if (\request()->has('changePlan')) {
            $newPlan = \request('plan');
            $user = \auth()->user();
            $user->plan_user_id = $newPlan;
            $user->update();
        }
        $this->forgetNewsletter();
        $plans = PlanUser::all();
        $plan = request('plan');
        return view('users.plans', compact('plans', 'plan','notificationsReaded'));
    }

    public function registration_type()
    {
        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        $this->forgetNewsletter();
        $plan = request('plan');
        Session::put('plan', $plan);
        $type = \request('type');
        return view('auth.registration_type', compact('plan', 'type','notificationsReaded'));
    }

    public function index(Request $request)
    {
        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        return view('workers.index',compact('notificationsReaded'));
    }

    public function show(User $worker)
    {
        $this->forgetNewsletter();
        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        $worker = User::withLikes()->where('id', '=', $worker->id)->first();
        $randomUsers = User::Independent()->Payed()->NoBan()->orderBy('role_id',
            'DESC')->withLikes()->limit(2)->inRandomOrder()->where('slug', '!=', $worker->slug)->get();
        $randomPhrasing = CatchPhraseUser::all()->random();
        return view('workers.show', compact('worker','notificationsReaded', 'randomPhrasing', 'randomUsers'));
    }

    public function payed(Request $request, User $user)
    {
        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        if (\request()->has('plan')) {
            $newPlan = \request('plan');
            $user = \auth()->user();
            $user->plan_user_id = $newPlan;
            $user->end_plan = null;
            $user->sending_time_expire = 0;
            $user->is_payed = 0;
            $user->update();
        }
        $this->forgetNewsletter();
        if (\auth()) {
            if ($request->plan == 1) {
                $user = \auth()->user();
                $trial = Carbon::now()->addDays(7)->addHours(2);
                $user->end_plan = $trial;
                $user->is_payed = 1;
                $user->sending_time_expire = 0;
                $user->plan_user_id = $request->plan;
                Session::forget('plan');
                Session::forget('user');
                $user->save();
                return \redirect(route('dashboard.profil'));
            }
            $plan = PlanUser::where('id', '=', $request->plan)->first();
        } else {
            $plan = PlanUser::where('id', '=', $request->user()->plan_user_id)->first();
        }
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
            'Votre compte est presque finalisé, il sera opérationnel qu\'après reçu de votre payement&nbsp;!');
        return view('users.payed', compact('plan','notificationsReaded', 'intent', 'stripe_key'));
    }

    public function plansAlreadyUser()
    {
        $this->forgetNewsletter();
        $plans = PlanUser::all();
        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        return view('users.plans', compact('plans','notificationsReaded'));
    }

    public function payedUser(Request $request, User $user)
    {
        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        $this->forgetNewsletter();
        $user = Auth::user();
        $user->is_payed = 1;
        $user->update();
        if ($user->plan_user_id == 2) {
            $days = 1;
        } else {
            $days = 3;
        }
        $trial = Carbon::now()->addMonth($days)->addHours(2);
        $user->end_plan = $trial;
        $user->plan_user_id = $request->plan;
        Session::flash('success-inscription',
            'Votre compte est désormais opérationnel, merci de votre confiance&nbsp;!');
        $user->update();
        Session::forget('plan');
        Session::forget('user');
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->send(new NewUserAdmin($user));
        Mail::to(\auth()->user()->email)
            ->send(new NewUser($user));
        return \redirect(route('dashboard.profil',compact('notificationsReaded')));
    }

    protected function forgetNewsletter()
    {
        \request()->session()->forget('newsletter');
    }
}
