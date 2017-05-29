<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\CustomerData;

class UserController extends Controller
{

    public function createCustomerId() {
        try {
            $query = "SELECT reserve_next_customer_id AS id FROM reserve_next_customer_id(?)";
            $next_customer = DB::select($query, ['root']);        

            $customer_id = $next_customer[0]->id;

            $customer = new CustomerData;
            
            $customer->customer_id = $customer_id;

            $customer->save();

            //  store id in session
            session(['customer_id' => $customer_id]);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }

        return 200;
    }

}
