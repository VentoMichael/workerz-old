<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class UserLikeController extends Controller
{
    public function store(User $worker){
        $worker->likeU(auth()->id());
         return Redirect::to(URL::previous() . "#search")->with('loveOk', $worker->name . ' a été aimé, merci&nbsp!');
    }
    public function delete(User $worker){
        $worker->dislikeU(auth()->id());
         return Redirect::to(URL::previous() . "#search")->with('loveNotOk', 'Le j\'aime a bien été retiré, merci&nbsp!');
    }
}
