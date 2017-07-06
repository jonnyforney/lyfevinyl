<?php

namespace App\Http\Controllers;

use Auth;
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

    public function save(Request $request)
    {
      $step = ucwords(camel_case($request['step']));

      $class_name = 'App\\Classes\\'.$step;
      $step_class = new $class_name;

      // store to db if logged in, otherwise save in session
      if(Auth::check()) {
        return $step_class->store((object)$request['data']);
      }

      return $step_class->save((object)$request['data']);
    }
}
