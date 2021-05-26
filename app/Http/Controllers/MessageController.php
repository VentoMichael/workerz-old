<?php

namespace App\Http\Controllers;

use App\Mail\NewMessageFromDashboard;
use App\Models\Announcement;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $firstUser = User::first();
        return view('conversations.index', compact('firstUser'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $messages = Message::whereRaw("((from_id = ".\auth()->user()->id." AND to_id = $user->id) OR (from_id = $user->id AND to_id =".\auth()->user()->id."))")->orderBy('created_at',
            'DESC')->paginate(20);
        $user = User::where('slug', '=', $user->slug)->firstOrFail();
        return view('conversations.show', compact('messages','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\RedirectResponse p\RedirectResponse
     */
    public function store(Request $request)
    {
        Validator::make(\request()->all(), [
            'message' => 'required',
        ])->validate();
        $message = new Message();
        $message->content = $request->message;
        $message->from_id = $request->from_id;
        $message->to_id = $request->to_id;
        $message->created_at = Carbon::now()->addHours(2);
        $message->save();
        //Mail::to($message->user->email)
        //->send(new NewMessageFromDashboard($message));
        Session::flash('success-ads',
            'Votre message a bien été envoyer');
        return Redirect::back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
