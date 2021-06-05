<?php

namespace App\Http\Controllers;

use App\Mail\ContactMe;
use App\Mail\NewNewsletterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        Validator::make(\request()->all(), [
            'newsletter' => 'required',
        ])->validate();
        if ($request->newsletter) {
            $request->session()->put('newsletter', '1');
            if (!Newsletter::hasMember($request->newsletter)) {
                Newsletter::subscribe($request->newsletter);
                return back()->with('successNew', 'Votre inscription à notre newsletter a bien été prise en compte&nbsp!');
            }else{
                return back()->with('failureNew', 'Oops&nbsp! Vous êtes déjà inscris&nbsp!');
            }
        }
    }
}
