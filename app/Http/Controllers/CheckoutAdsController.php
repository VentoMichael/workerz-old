<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutAdsController extends Controller
{
    public function checkout()
    {
        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe_key = env('STRIPE_KEY');
        $amount = 100;
        $amount *= 100;
        $amount = (int) $amount;

        $payment_intent = \Stripe\PaymentIntent::create([
            'description' => 'Stripe Test Payment',
            'amount' => $amount,
            'currency' => 'INR',
            'description' => 'Payment From Codehunger',
            'payment_method_types' => ['card'],
        ]);
        $intent = $payment_intent->client_secret;

        return view('checkout.credit-card',compact('intent','stripe_key'));

    }

    public function afterPayment()
    {
        echo 'Payment Has been Received';
    }
}
