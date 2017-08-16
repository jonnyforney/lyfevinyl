<?php

namespace App\Classes;

use App\Order;
use App\Classes\Step;

use \Stripe\{Stripe, Charge, Customer};
use \Illuminate\Database\Eloquent\Collection;

class Payment implements Step
{
    function __construct()
    {
    }

    public function save($data)
    {        

    }

    function store($data)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $customer = Customer::create([
            'email' => request('stripeEmail'),
            'source' => request('stripeToken')
        ]);

        // Charge::create([
        //     'customer' => $customer->id,
        //     'amount' => 20000,
        //     'currency' => 'usd'
        // ]);

        return 'stripe customer created';
    }
}
