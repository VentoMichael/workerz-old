<?php

namespace App\Http\Controllers;

use App\Mail\AdsCreated;
use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\CatchPhraseAnnouncement;
use App\Models\Category;
use App\Models\PlanAnnouncement;
use App\Models\Province;
use App\Models\StartMonth;
use App\Notifications\AdCreated;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function plans()
    {
         if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        $plans = PlanAnnouncement::all();
        $plan = \request()->plan;
        Session::put('plan', $plan);
        return view('announcements.plans', compact('plans','notificationsReaded', 'plan'));
    }

    public function index()
    {
         if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        return view('announcements.index',compact('notificationsReaded'));
    }

    public function show(Announcement $announcement)
    {
         if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        $announcement = Announcement::withLikes()->where('id', '=', $announcement->id)->first();
        $announcement->incrementReadCount();
        $randomAds = Announcement::Published()
            ->NoBan()
            ->Payement()->Adspayed()->orderBy('plan_announcement_id',
                'DESC')->withLikes()->limit(2)->inRandomOrder()->where('slug','!=',$announcement->slug)->get();
        $randomPhrasing = CatchPhraseAnnouncement::all()->random();
        $user = auth()->user();
        return view('announcements.show', compact('randomPhrasing', 'randomAds','notificationsReaded', 'announcement', 'user'));
    }

    /*
     *
     * */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        $plan = \request()->plan;
        Session::put('plan', $plan);

        $categories = Category::withCount("announcements")->get()->sortBy('name');
        $regions = Province::withCount("announcements")->get()->sortBy('name');
        $disponibilities = StartMonth::withCount("announcements")->get()->sortBy('id');
        return view('announcements.create', compact('plan', 'disponibilities','notificationsReaded', 'categories', 'regions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $plan = Session::get('plan');
        if (!$request->has('is_payed')) {
            $data = Validator::make($request->all(), [
                'title' => 'required',
                'picture' => 'image:jpg,jpeg,png|max:2048',
                'description' => 'required|max:256',
                'job' => 'required|max:256',
                'pricemax'=> 'numeric|max:999999|nullable',
                'location' => 'required|not_in:0',
                'categoryAds' => 'required|array|max:'.\request('plan'),
                'startmonth' => 'required',
            ])->validate();
        }
        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->catchPhrase = $request->catchPhrase;
        $announcement->slug = Str::slug($request->title);

        if ($request->hasFile('picture')) {
            Storage::makeDirectory('ads');
            $filename = request('picture')->hashName();
            $img = Image::make($request->file('picture'))->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path('ads/'.$filename));
            $announcement->picture = 'ads/'.$filename;
        }
        $announcement->description = $request->description;
        $announcement->job = $request->job;
        $announcement->pricemax = $request->pricemax;
        $announcement->user_id = Auth::id();
        $announcement->province_id = $request->location;
        $announcement->start_month_id = $request->startmonth;
        $announcement->plan_announcement_id = $plan;
        $ct = new AnnouncementCategory();
        $ct->category_id = $request->categoryAds;
        if ($plan == 1 || \request()->old('plan') == 1 || \request('plan') == 1) {
            if ($request->has('is_draft')) {
                $announcement->is_draft = true;
                $payed = false;
                Session::forget('plan');
                Session::flash('success-inscription', 'Votre annonce a été enregistrer dans vos brouillons&nbsp;!');
                $announcement->is_payed = $payed;
                $announcement->save();
                return redirect('/dashboard/ads/draft/'.$announcement->slug);
            } else {
                $announcement->is_draft = false;
                $payed = true;
                $trial = Carbon::now()->addDays(7)->addHours(2);
                $announcement->end_plan = $trial;
                Mail::to(env('MAIL_FROM_ADDRESS'))
                    ->send(new AdsCreated($data));
                Session::forget('plan');
                Session::flash('success-inscription',
                    'Votre annonce a été bien mise en ligne&nbsp;!');
            }
            $announcement->is_payed = $payed;
            $announcement->save();
            $announcement->categoryAds()->attach($ct->category_id);
            \auth()->user()->notify(new AdCreated($announcement));
            return redirect('/dashboard/ads/'.$announcement->slug);
        } else {
            if ($request->has('is_draft')) {
                $announcement->is_draft = true;
                $payed = false;
                Session::flash('success-inscription', 'Votre annonce a été enregistrer dans vos brouillons&nbsp;!');
                $announcement->is_payed = $payed;
                $announcement->save();
                $announcement->categoryAds()->attach($ct->category_id);
                Session::forget('plan');
                return redirect('/dashboard/ads/draft/'.$announcement->slug);
            } else {
                $announcement->is_draft = false;
                $payed = false;
                Session::flash('success-inscription',
                    'Votre annonce ne sera visible qu\'aprés payement&nbsp;!');
            }
            $announcement->is_payed = $payed;
            $announcement->save();
            $announcement->categoryAds()->attach($ct->category_id);
            $planId = PlanAnnouncement::where('id', '=', $plan)->first();
            $announcement->user->notify(new AdCreated($announcement));
            Session::flash('success-ads',
                'Votre annonce est presque finalisée, elle sera visible qu\'après reçu de votre payement&nbsp;!');
            return redirect(route('announcements.payed', compact('planId', 'announcement', 'plan')));
        }
    }

    public function payed(Request $request, Announcement $announcement)
    {
         if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        if ($request->publish == true) {
            $announcement = Announcement::where('slug', '=', $request->announcement);
            $planId = PlanAnnouncement::where('id', '=', $request->planAd)->first();
            $plan = $request->planAd;
        } else {
            $plan = Session::get('plan');
            $planId = PlanAnnouncement::where('id', '=', $plan)->first();
        }
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe_key = env('STRIPE_KEY');
        $amount = $planId->price;
        $amount *= 100;
        $amount = (int) $amount;
        $payment_intent = \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'EUR',
            'description' => 'Paiement pour une annonce',
            'payment_method_types' => ['card'],
        ]);
        $intent = $payment_intent->client_secret;

        return view('announcements.payed',
            compact('planId','notificationsReaded', 'plan', 'intent', 'stripe_key'));
    }

    public function payedAds(Announcement $announcement)
    {
         if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        $announcement = Announcement::where('slug', '=', \request()->slug)->first();
        $announcement->is_payed = true;
        $announcement->is_draft = false;
        if ($announcement->plan_announcement_id == 2) {
            $days = 15;
        } else {
            $days = 30;
        }
        $trial = Carbon::now()->addDays($days)->addHours(2);
        $announcement->end_plan = $trial;
        Session::flash('success-inscription',
            'Votre annonce est désormais en ligne, merci de votre confiance&nbsp;!');
        $announcement->update();
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->send(new AdsCreated($announcement));
        \auth()->user()->notify(new AdCreated($announcement));
        Session::forget('plan');
        return redirect('/dashboard/ads/'.$announcement->slug);
    }
}
