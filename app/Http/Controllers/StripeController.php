<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;

class StripeController extends Controller
{
    public function stripe()
    {
        return view('stripe');
    }

    public function stripePost(Request $request)
    {
        // dd($request->stripeToken);
        // Stripe\StripeClient(env('STRIPE_SECRET'));
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // Stripe\Charge::create([
        //     "amount" => 100 * 100,
        //     "currency" => "INR",
        //     "source" => $request->stripeToken,
        //     "description" => "This is test payment",
        // ]);

        Stripe\Charge::create(
            [
                // 'mode' => 'payment',
                "amount" => 100 * 100,
                "currency" => "AUD",
                // 'stripe_account' => 'acct_1MlcsCQhHfdpdP56',
                //   'line_items' => [['price' => '{{PRICE_ID}}', 'quantity' => 1]],
                // 'payment_intent_data' => ['application_fee_amount' => 123],
                "source" => $request->stripeToken,
                "description" => "This is test payment",
                // 'stripe_account' => 'acct_1MlcsCQhHfdpdP56'
                //   'success_url' => 'http://example.com/success',
                //   'cancel_url' => 'http://localhost:8000/',
            ],
            ['stripe_account' => 'acct_1MlcimFyXprrBhvk']
        );
        Session::flash('success', 'Payment Successful !');

        return back();
    }
}
