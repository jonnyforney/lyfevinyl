<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //  create new order id
    public function create()
    {
        $id = Order::createOrderId();

        return [
            'created' => true,
            'order_id' => $id
        ];
    }

    //  create a new order
    public function add(Request $request)
    {
        $id = Order::createNewOrder($request);        

        return $id;
    }
}
