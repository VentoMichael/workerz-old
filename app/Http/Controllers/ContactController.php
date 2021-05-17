<?php

namespace App\Http\Controllers;

use App\Mail\ContactMe;
use App\Mail\ContactUser;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
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
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        if ($request->surname) {
            $surname = $request->surname;
        } else {
            $surname = null;
        }
        Contact::create([
            'name' => $data['name'],
            'surname' => $surname,
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->send(new ContactMe($data));
        Mail::to($data['email'])
            ->send(new ContactUser($data));
        return Redirect::to(URL::previous()."#createMsg")->with('success-send', 'Votre message a été envoyé avec succès.
        Nous vous contacterons bientôt !');
    }

}
