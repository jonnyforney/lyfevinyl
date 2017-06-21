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
}
