<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageReceived;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $notificationsReaded = auth()->user()->notifications->where('read_at',null);
        $noReadMsgs = count(auth()->user()->talkedTo->where('is_read',0));
        $firstUser = User::first();
        return view('conversations.index', compact('firstUser','notificationsReaded','noReadMsgs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $notificationsReaded = auth()->user()->notifications->where('read_at',null);
        $noReadMsgs = count(auth()->user()->talkedTo->where('is_read',0));
        $messages = Message::
        with('user','receiver')
->whereRaw("((from_id = ".\auth()->id()." AND to_id = $user->id) OR (from_id = $user->id AND to_id =".\auth()->id()."))")
->orderBy('created_at', 'DESC')->paginate(20);
        foreach ($messages as $message) {
            if ($message->receiver->id === auth()->id()){
                $message->is_read = 1;
                $message->save();
            }
        }
        return view('conversations.show', compact('messages','notificationsReaded','noReadMsgs','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\RedirectResponse p\RedirectResponse
     */
    public function store(Request $request)
    {
        if (\request()->has('talkTo')) {
            $user = $request->slug;
            $message = new Message();
            $message->content = \request()->message;
            $message->from_id = \request()->from_id;
            $message->to_id = \request()->to_id;
            $message->created_at = Carbon::now()->addHours(2);
            $message->save();
            return \redirect(route('dashboard.messagesShow', $user));
        }
        Validator::make(\request()->all(), [
            'message' => 'required',
        ])->validate();
        $message = new Message();
        $message->content = $request->message;
        $message->from_id = $request->from_id;
        $message->to_id = $request->to_id;
        $message->created_at = Carbon::now()->addHours(2);
        $message->save();
        Session::flash('success-ads',
            'Votre message a bien été envoyer&nbsp;!');
        event(
            new \App\Events\Message(
                $message->user->name,
                $message->content
            ));
        $receiper = User::where('email',$message->user->email)->first();
        $receiper->notify(new MessageReceived($message));
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteConversations(User $user)
    {
        Message::where('from_id','=',\auth()->id())->where('to_id','=',$user->id)->delete();
        return Redirect::route('dashboard.messages')->with('success-delete', 'Conversation supprimée&nbsp!');
    }
}
