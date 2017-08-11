<?php

namespace App\Classes;

use App\ShipToAddress;
use App\Classes\Step;
use \Illuminate\Database\Eloquent\Collection;

class Shipping implements Step
{
    function __construct()
    {
    }

    public function save($data)
    {
        $order = session('order');

        $order->put('shipping', $data->shipping);

        session(['order' => $order]);

        return ['order_id' => $order['id'], 'status' => 'shipping saved into session'];
    }

    public function store($data)
    {
        $address = ShipToAddress::where('order_id',$data->order_id)->first();

        $address = (!empty($address)) ? $address : new ShipToAddress;

        $data->shipping = (object)$data->shipping;

        $address->order_id = $data->order_id;
        $address->first_name = $data->shipping->firstName;
        $address->last_name = $data->shipping->lastName;
        $address->address_one = $data->shipping->addressLineOne;
        $address->address_two = $data->shipping->addressLineTwo;
        $address->city = $data->shipping->addressCity;
        $address->state = $data->shipping->addressState;
        $address->zip = '43617';
        $address->country = 'USA';
        // $address->zip = $data->shipping->addressZip;
        // $address->country = $data->shipping->addressCountry;
        $address->save();

        return ['order_id' => $data->order_id, 'status' => 'updated'];
    }
}
