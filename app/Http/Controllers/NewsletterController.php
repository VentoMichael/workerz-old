<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class NewsletterController extends Controller
{

    public function store(Request $request)
    {
        if (!Newsletter::isSubscribed($request->newsletter) )
        {
            Newsletter::subscribe($request->newsletter);
            return back()->with('successNew', 'Votre inscription a bien été prise en compte !');
        }
        return back()->with('failureNew', 'Oops ! Vous êtes déjà inscris !');
    }
}
