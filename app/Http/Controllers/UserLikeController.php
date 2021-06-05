<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserLikeController extends Controller
{
    public function store(User $worker){
        $worker->likeU(auth()->id());
        return back()->with('loveOk', 'L\' entreprise a été aimé, merci&nbsp!');
    }
    public function delete(User $worker){
        $worker->dislikeU(auth()->id());
        return back()->with('loveNotOk', 'Le j\'aime a bien été retiré, merci&nbsp!');
    }
}
