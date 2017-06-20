<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $id = Order::createOrderId();

        return [
            'created' => true,
            'order_id' => $id
        ];
    }
}
