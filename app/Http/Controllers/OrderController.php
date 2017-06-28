<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //  create a new order
    public function add(Request $request)
    {
        $id = Order::createNewOrder($request);        

        return $id;
    }

    public function load(Request $request)
    {
        $order = Order::where('id', $request['order_id'])->first();

        if(empty($order))
            $order = session('order');        

        return $order;
    }
}
