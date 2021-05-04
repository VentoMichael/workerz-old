<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class AnnouncementLikeController extends Controller
{
    public function store(Announcement $announcement){
        $announcement->like(auth()->id());
        return back();
    }
    public function delete(Announcement $announcement){
        $announcement->dislike(auth()->id());
        return back();
    }
}
