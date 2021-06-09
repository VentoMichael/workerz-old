<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AnnouncementLikeController extends Controller
{
    public function store(Announcement $announcement){
        $announcement->like(auth()->id());
        return Redirect::to(URL::previous() . "#search")->with('loveOk', ucfirst($announcement->title) . ' a été aimé, merci&nbsp;!');
    }
    public function delete(Announcement $announcement){
        $announcement->dislike(auth()->id());
        return Redirect::to(URL::previous() . "#search")->with('loveNotOk', 'Le j\'aime a bien été retiré, merci&nbsp;!');
    }
}
