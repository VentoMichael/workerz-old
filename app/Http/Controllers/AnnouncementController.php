<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\CatchPhraseAnnouncement;
use App\Models\Category;
use App\Models\PlanAnnouncement;
use App\Models\PlanUser;
use App\Models\Province;
use App\Models\StartMonth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        $announcements = Announcement::Published()->NoBan()->Payement()->orderBy('plan_announcement_id',
            'DESC')->orderBy('created_at', 'DESC')->withLikes()->paginate(4)->onEachSide(0);
        $categories = Category::withCount("announcements")->get()->sortBy('name');
        $regions = Province::withCount("announcements")->get()->sortBy('name');
        $user = auth()->user();

        return view('announcements.index', compact('announcements', 'categories', 'regions', 'user'));
    }

    public function show(Announcement $announcement)
    {
        $randomAds = Announcement::Published()->orderBy('plan_announcement_id',
            'DESC')->withLikes()->limit(2)->inRandomOrder()->get();
        $randomPhrasing = CatchPhraseAnnouncement::all()->random();
        $user = auth()->user();
        $announcement = Announcement::Published()->with('user')->withLikes()->get()->find($announcement);;
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
        $categories = Category::withCount("announcements")->get()->sortBy('name');
        $regions = Province::withCount("announcements")->get()->sortBy('name');
        $disponibilities = StartMonth::withCount("announcements")->get()->sortBy('id');
        Session::flash('success-inscription',
            'Votre inscription à été un succés ! Il suffit de terminer le paiement et votre entreprise sera visible.');
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
        Validator::make($request->all(), [
            'title' => 'required|unique:announcements',
            'slug' => 'required',
            'picture' => 'image:jpg,jpeg,png,svg|file',
            'description' => 'required|max:256',
            'job' => 'required|max:256',
        ]);

        $plan = $request->plan;
        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->catchPhrase = $request->catchPhrase;
        $announcement->slug = Str::slug($request->title);

        if ($request->hasFile('picture')) {
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
        $announcement->start_month_id = $request->disponibility;
        $announcement->plan_announcement_id = $plan;

        $ct = new AnnouncementCategory();
        $ct->category_id = $request->category_job;
        if ($plan == 1) {
            if ($request->has('is_draft')) {
                $announcement->is_draft = true;
                $payed = true;
                Session::flash('success-inscription', 'Votre annonce a été enregistrer dans vos brouillons !');
            } else {
                $announcement->is_draft = false;
                $payed = true;
                Session::flash('success-inscription',
                    'Votre annonce sera mise en ligne après approbation de l\'administrateur !');
            }
        } else {
            if ($request->has('is_draft')) {
                $announcement->is_draft = true;
                $payed = true;
                Session::flash('success-inscription', 'Votre annonce a été enregistrer dans vos brouillons !');
            } else {
                $payed = false;
                $announcement->is_draft = false;
                Session::flash('success-inscription', 'Votre annonce a été bien mise en ligne !');
            }
        }
        $announcement->is_payed = $payed;
        $announcement->save();
        $announcement->categoryAds()->attach($ct->category_id);

        return redirect(route('dashboard/ads'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function payed(Request $request)
    {
        $planId = PlanAnnouncement::where('id', '=', $request->plan)->get();
        $plan = $request->plan;

        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->catchPhrase = $request->catchPhrase;
        $announcement->slug = Str::slug($request->title);

        if ($request->hasFile('picture')) {
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
        $announcement->start_month_id = $request->disponibility;
        $announcement->plan_announcement_id = $plan;

        $ct = new AnnouncementCategory();
        $ct->category_id = $request->category_job;
        if ($plan === 1) {
            if ($request->has('is_draft')) {
                $announcement->is_draft = true;
                Session::flash('success-inscription', 'Votre annonce a été enregistrer dans vos brouillons !');
            } else {
                $announcement->is_draft = false;
                Session::flash('success-inscription',
                    'Votre annonce sera mise en ligne après approbation de l\'administrateur !');
            }
        } else {
            if ($request->has('is_draft')) {
                $announcement->is_draft = true;
                Session::flash('success-inscription', 'Votre annonce a été enregistrer dans vos brouillons !');
            } else {
                $announcement->is_draft = false;
                Session::flash('success-inscription', 'Votre annonce a été bien mise en ligne !');
            }
        }
        $announcement->is_payed = false;
        $announcement->save();
        $announcement->categoryAds()->attach($ct->category_id);
        if ($request->has('is_payed')){
            $announcement->is_payed = true;
        }
        Session::flash('success-inscription',
            'Il suffit de terminer le paiement et votre annonce sera visible.');
        return view('announcements.payed',
            compact('planId'));
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
