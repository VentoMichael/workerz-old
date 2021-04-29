<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class ContactController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        request()->validate([
            'name'=> 'required',
            'message'=> 'required',
            'email'=> 'required|email',
            'subject'=> 'required',
        ]);
        $message = new Contact();
        $message->name = request('name');
        $message->surname = request('surname');
        $message->email = request('email');
        $message->subject = request('subject');
        $message->message = request('message');
        $message->save();
        //Mail::to(env('MAIL_FROM_ADDRESS'))
        //    ->send(new \App\Mail\contact());
        //Mail::to(request('email'))
        //    ->send(new notificationForUser());
        return Redirect::to(URL::previous() . "#createMsg")->with('success-send', 'Votre message a été envoyé avec succès.
        Nous vous contacterons bientôt !');
    }

}
