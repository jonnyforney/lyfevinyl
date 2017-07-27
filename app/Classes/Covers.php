<?php

namespace App\Classes;

use App\Classes\Step;

class Covers implements Step
{
    function __construct()
    {
    }

    public function save($data)
    {
        $order = session('order');

        $order->put('front_cover_path', $data->front_cover_path);

        session(['order' => $order]);

        return ['order_id' => $order['id'], 'status' => 'saved into session'];
    }

    public function store($data)
    {
        $order = Order::where('id',$data->order_id)->first();

        $order->front_cover_path = $data->front_cover_path;
        $order->save();

        return ['order_id' => $order->id, 'status' => 'updated'];
    }
}
