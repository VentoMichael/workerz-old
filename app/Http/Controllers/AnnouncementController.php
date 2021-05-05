<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\CatchPhraseAnnouncement;
use App\Models\Category;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function plans()
    {
        return view('announcements.plans');
    }

    public function index()
    {
        $announcements = Announcement::Published()->with('user','startmonth')->orderBy('created_at', 'DESC')->withLikes()->paginate(4)->onEachSide(0);
        $rq = \request()->query();
        foreach($announcements as $announcement){
        if (strlen($announcement->description) > 60 && !\request(['showmore'.$announcement->id])) {
            $announcement->description = substr($announcement->description, 0, 60).'...';
        }}
        $categories = Category::with('announcements')->withCount("announcements")->get()->sortBy('name');
        $regions = Province::with('announcements')->withCount("announcements")->get()->sortBy('name');
        $user = auth()->user();

        return view('announcements.index', compact('announcements','rq','categories','regions','user'));
    }

    public function show(Announcement $announcement)
    {
        $randomAds = Announcement::Published()->orderBy('plan_announcement_id','DESC')->withLikes()->limit(2)->inRandomOrder()->get();
        $randomPhrasing = CatchPhraseAnnouncement::all()->random();
        $user = auth()->user();
        $announcement = Announcement::Published()->with('user')->withLikes()->get()->find($announcement);;
        return view('announcements.show', compact('randomPhrasing','randomAds','announcement','user'));
    }

    /*
     *
     * */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if (isset($_GET['plan1']) || isset($_GET['plan2']) || isset($_GET['plan3'])) {
            return view('announcements.create');
        } else {
            return redirect(route('announcements.plans'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
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
