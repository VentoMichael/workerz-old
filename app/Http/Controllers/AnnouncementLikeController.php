<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class AnnouncementLikeController extends Controller
{
    public function store(Announcement $announcement){
        $announcement->like(auth()->id());
        return back()->with('loveOk', 'L\' annonce a été aimé, merci&nbsp;!');
    }
    public function delete(Announcement $announcement){
        $announcement->dislike(auth()->id());
        return back()->with('loveNotOk', 'Le j\'aime a bien été retiré, merci&nbsp;!');
    }
}
