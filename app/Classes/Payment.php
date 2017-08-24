<?php

namespace App\Classes;

use App\Order;
use App\Classes\Step;

use \Stripe\{Stripe, Charge, Customer};
use \Illuminate\Database\Eloquent\Collection;

class Payment implements Step
{
    protected $customer = null;
    protected $charged = false;
    protected $amount = 20000;

    function __construct()
    {
    }

    public function save($data)
    {        
        return $this->store($data);
    }

    public function store($data)
    {
        $msg = 'customer not charged, waiting for the order to be finalized';

        do {
            if($data->status == 'complete') {
                Stripe::setApiKey(config('services.stripe.secret'));

                $data->shipping = (object)$data->shipping;
                $data->payment = (object)$data->payment;

                $this->customer = Customer::create([
                    'email' => $data->shipping->email,
                    'source' => $data->payment->stripeToken
                ]);

                $this->pay();

                if($this->charged->captured) {
                    $msg = 'customer charged';
                    break;
                }

                $msg = 'stripe customer created';
            }
        } while (0);        

        return ['order_id' => $data->order_id, 'status' => $msg];
    }

    protected function pay() {
        $this->charged = Charge::create([
            'customer' => $this->customer->id,
            'amount' => $this->amount,
            'currency' => 'usd'
        ]);
    }
}
