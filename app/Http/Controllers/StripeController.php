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
        $stripe = new \Stripe\StripeClient('sk_test_51JCKihHrHTHAD5zZ7ELiP2pz6vTEL8vE120Ed8X0vPSvfzOBoARKkVAFm0VFg958FkXGSRJatofINWoHCXdzEOzW00NLLlB5ps');

        $pay = $stripe->checkout->sessions->create(
            [
                'mode' => 'payment',
                'line_items' => [['price' => 'price_1Mm8ViHrHTHAD5zZiARHNNQ9', 'quantity' => 1]],
                'payment_intent_data' => [
                    'application_fee_amount' => 20,
                    'transfer_data' => ['destination' => 'acct_1MllojQWrIBytdL2'],
                ],
                'success_url' => 'http://localhost:8000/success',
                'cancel_url' => 'http://localhost:8000//cancel',
            ]
        );
        dd($pay->url);
        // Session::flash('success', 'Payment Successful !');

        // return back();
    }

    public function get_connects()
    {
        $stripe = new \Stripe\StripeClient('sk_test_51JCKihHrHTHAD5zZ7ELiP2pz6vTEL8vE120Ed8X0vPSvfzOBoARKkVAFm0VFg958FkXGSRJatofINWoHCXdzEOzW00NLLlB5ps');

        $connect = $stripe->accounts->retrieve('acct_1MllojQWrIBytdL2', []);
        return response()->json([
            'data' => $connect
        ]);
    }

    public function create_customer(Request $response)
    {
        $stripe = new \Stripe\StripeClient('sk_test_51JCKihHrHTHAD5zZ7ELiP2pz6vTEL8vE120Ed8X0vPSvfzOBoARKkVAFm0VFg958FkXGSRJatofINWoHCXdzEOzW00NLLlB5ps');

        $stripe->customers->create(
            ['name' => 'abc'],
            ['email' => 'abc@example.com'],
            ['stripe_account' => 'acct_1MllojQWrIBytdL2']
        );
    }

    public function create_connect()
    {
        $stripe = new \Stripe\StripeClient('sk_test_51JCKihHrHTHAD5zZ7ELiP2pz6vTEL8vE120Ed8X0vPSvfzOBoARKkVAFm0VFg958FkXGSRJatofINWoHCXdzEOzW00NLLlB5ps');

        $connect = $stripe->accounts->create([
            'type' => 'custom',
            'country' => 'AU',
            'email' => 'peter@example.com',
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
        ]);
        dd($connect);
    }

    public function create_links()
    {
        $stripe = new \Stripe\StripeClient('sk_test_51JCKihHrHTHAD5zZ7ELiP2pz6vTEL8vE120Ed8X0vPSvfzOBoARKkVAFm0VFg958FkXGSRJatofINWoHCXdzEOzW00NLLlB5ps');

        $stripe->accountLinks->create(
            [
                'account' => 'acct_1Mn1UPH2RccYzpeM',
                'refresh_url' => 'https://example.com/reauth',
                'return_url' => 'https://example.com/return',
                'type' => 'account_onboarding',
                'collect' => 'eventually_due',
            ]
        );
    }

    public function success()
    {
        return view('success');
    }

    public function fail()
    {
        return view('fail');
    }
}
