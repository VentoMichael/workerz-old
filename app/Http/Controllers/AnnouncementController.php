<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\CatchPhraseAnnouncement;
use App\Models\Category;
use App\Models\Province;
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
        $announcements = Announcement::Published()->with('user')->orderBy('created_at', 'DESC')->paginate(4)->onEachSide(0);
        $rq = \request()->query();
        foreach($announcements as $announcement){
        if (strlen($announcement->description) > 60 && !isset($_GET['showmore'.$announcement->id])) {
            $announcement->description = substr($announcement->description, 0, 60).'...';
        }}
        $categories = Category::with('announcements')->withCount("announcements")->get()->sortBy('name');
        $regions = Province::with('announcements')->withCount("announcements")->get()->sortBy('name');
        return view('announcements.index', compact('announcements','rq','categories','regions'));
    }

    public function show(Announcement $announcement)
    {
        $randomPhrasing = CatchPhraseAnnouncement::all()->random();
        return view('announcements.show', compact('randomPhrasing','announcement'));
    }

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
