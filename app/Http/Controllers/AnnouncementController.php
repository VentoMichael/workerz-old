<?php

namespace App\Http\Controllers;

use App\Mail\AdsCreated;
use App\Mail\AdsCreatedUser;
use App\Mail\ContactMe;
use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\CatchPhraseAnnouncement;
use App\Models\Category;
use App\Models\PlanAnnouncement;
use App\Models\Province;
use App\Models\StartMonth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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
        $plans = PlanAnnouncement::all();

        return view('announcements.plans', compact('plans'));
    }

    public function index()
    {
        $user = auth()->user();
        return view('announcements.index', compact('user'));
    }

    public function show(Announcement $announcement)
    {
        $announcement = Announcement::withLikes()->where('id', '=', $announcement->id)->first();

        if(!\request()->session()->has('visit')) {
            \request()->session()->put('visit', 1);
            $announcement->incrementReadCount();
        }
        $randomAds = Announcement::Published()
            ->NoBan()
            ->Payement()->Adspayed()->orderBy('plan_announcement_id',
                'DESC')->withLikes()->limit(2)->inRandomOrder()->get();
        $randomPhrasing = CatchPhraseAnnouncement::all()->random();
        $user = auth()->user();
        return view('announcements.show', compact('randomPhrasing', 'randomAds', 'announcement', 'user'));
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
        $plan = $request->plan;
        Session::put('plan',$plan);
        $categories = Category::withCount("announcements")->get()->sortBy('name');
        $regions = Province::withCount("announcements")->get()->sortBy('name');
        $disponibilities = StartMonth::withCount("announcements")->get()->sortBy('id');
        return view('announcements.create', compact('plan', 'disponibilities', 'categories', 'regions'));

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
                'title' => 'required|unique:announcements',
                'picture' => 'image:jpg,jpeg,png,svg|file',
                'description' => 'required|max:256',
                'job' => 'required|max:256',
                'location' => 'required|not_in:0',
                'categoryAds' => 'required|array|max:'.$plan,
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
            })->save(storage_path('app/public/ads/'.$filename));
            $announcement->picture = 'ads/'.$filename;
        }
        $announcement->description = $request->description;
        $announcement->job = $request->job;
        $announcement->pricemax = $request->price_max;
        $announcement->user_id = Auth::id();
        $announcement->province_id = $request->location;
        $announcement->start_month_id = $request->startmonth;
        $announcement->plan_announcement_id = $plan;
        $ct = new AnnouncementCategory();
        $ct->category_id = $request->category_job;
        if ($plan == 1 || \request()->old('plan') == 1) {
            if ($request->has('is_draft')) {
                $announcement->is_draft = true;
                $payed = true;
                Session::flash('success-inscription', 'Votre annonce a été enregistrer dans vos brouillons !');
            } else {
                $announcement->is_draft = false;
                $payed = true;
                $trial = Carbon::now()->addDays(7);
                $announcement->end_plan = $trial;
                Mail::to(env('MAIL_FROM_ADDRESS'))
                    ->send(new AdsCreated($data));
                Mail::to(\auth()->user()->email)
                    ->send(new AdsCreatedUser($data));
                Session::flash('success-inscription',
                    'Votre annonce a été bien mise en ligne !');
            }
            $announcement->is_payed = $payed;
            $announcement->categoryAds()->attach($ct->category_id);
            $announcement->save();
            return redirect(route('dashboard.ads'));
        } else {
            if ($request->has('is_draft')) {
                $announcement->is_draft = true;
                $payed = false;
                Session::flash('success-inscription', 'Votre annonce a été enregistrer dans vos brouillons !');
                $announcement->is_payed = $payed;
                $announcement->save();
                $announcement->categoryAds()->attach($ct->category_id);
                return redirect(route('dashboard.ads'));
            } else {
                $announcement->is_draft = false;
                $payed = false;
                Session::flash('success-inscription',
                    'Votre annonce ne sera visible qu\'aprés payement !');
            }
            $announcement->is_payed = $payed;
            $announcement->save();
            $announcement->categoryAds()->attach($ct->category_id);
            $planId = PlanAnnouncement::where('id', '=', $plan)->first();
            Session::flash('success-ads',
                'Votre annonce est presque finalisée, elle sera visible qu\'après reçu de votre payement !');
            return redirect(route('announcements.payed', compact('planId', 'announcement')));
        }
    }

    public function payed(Request $request)
    {
        $plan = Session::get('plan');
        $planId = PlanAnnouncement::where('id', '=', $request->planId)->first();

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
            compact('planId', 'plan', 'intent', 'stripe_key'));
    }

    public function payedAds()
    {
        $announcement = Announcement::where('user_id', '=', \auth()->user()->id)->latest('created_at')->first();
        $announcement->is_payed = true;
        if ($announcement->plan_announcement_id == 2) {
            $days = 15;
        } else {
            $days = 30;
        }
        $trial = Carbon::now()->addDays($days);
        $announcement->end_plan = $trial;
        Session::flash('success-inscription',
            'Votre annonce est désormais en ligne, merci de votre confiance !');
        $announcement->update();
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->send(new AdsCreated($announcement));
        Mail::to(\auth()->user()->email)
            ->send(new AdsCreatedUser($announcement));
        Session::forget('plan');
        return redirect(route('dashboard.ads'));
    }

    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
}
