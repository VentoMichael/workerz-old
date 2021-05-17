<?php

namespace App\Http\Controllers;

use App\Mail\ContactMe;
use App\Mail\NewNewsletterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        if ($request->newsletter) {

            if (!Newsletter::hasMember($request->newsletter)) {
                Newsletter::subscribe($request->newsletter);
                Mail::to(env('MAIL_FROM_ADDRESS'))
                    ->send(new NewNewsletterUser());
                return back()->with('successNew', 'Votre inscription à notre newsletter a bien été prise en compte !');
            }else{
                return back()->with('failureNew', 'Oops ! Vous êtes déjà inscris !');
            }
        }
    }
}
