<?php

namespace App\Classes;

use App\Order;
use App\Classes\Step;
use \Illuminate\Database\Eloquent\Collection;

class AlbumName implements Step
{
    function __construct()
    {
    }

    public function save($data)
    {        
        $order = collect([
            'id' => $data->order_id ?? '-1',
            'title' => $data->title
        ]);

        session(['order' => $order]);

        return ['order_id' => $order['id'], 'status' => 'title saved into session'];
    }

    function store($data)
    {
        if (empty($data->order_id)) {
           return ['order_id' => Order::createNewOrder($data)->id, 'status' => 'created'];
        }

        $order = Order::where('id',$data->order_id)->first();

        $order->title = $data->title;
        $order->save();

        return ['order_id' => $order->id, 'status' => 'updated'];
    }
}
