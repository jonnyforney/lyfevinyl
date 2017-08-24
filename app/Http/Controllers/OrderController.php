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

        $payload = (object)$request['data'];

        // store to db if logged in, otherwise save in session
        if(Auth::check()) {
            $db_save = (object)$step_class->store($payload);
        }
        
        //  update order_id with what was saved into the db
        if(isset($db_save->order_id)) {
            $payload->order_id = $db_save->order_id;
        }

        return $step_class->save($payload);
    }

    public function pay() {
        // Charge::create([
        //     'customer' => $customer->id,
        //     'amount' => 20000,
        //     'currency' => 'usd'
        // ]);
    }

    public function print()
    {
        dd(session()->all());
    }
}
