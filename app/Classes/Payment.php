<?php

namespace App\Classes;

use App\Order;
use App\Classes\Step;

use \Stripe\{Stripe, Charge, Customer};
use \Illuminate\Database\Eloquent\Collection;

class Payment implements Step
{
    protected $customer = null;
    protected $charged = null;
    protected $amount = 20000;

    function __construct()
    {
    }

    public function save($data)
    {        
        $this->store($data);
    }

    public function store($data)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $data->shipping = (object)$data->shipping;
        $data->payment = (object)$data->payment;

        $this->customer = Customer::create([
            'email' => $data->shipping->email,
            'source' => $data->payment->stripeToken
        ]);

        $this->pay();

        if($this->charged) {
            return 'customer charged';
        }

        return 'stripe customer created';
    }

    protected function pay() {
        $this->charged = Charge::create([
            'customer' => $this->customer->id,
            'amount' => $this->amount,
            'currency' => 'usd'
        ]);
    }
}
