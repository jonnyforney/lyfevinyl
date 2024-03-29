<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Order extends Model
{
    protected $table = 'orders';
    protected $keyType = 'string';
    public $incrementing = false;
    
    public function store($object)
    {
        $changed = false;

        foreach($object as $key => $value) {            
            $this->$key = $value;
            $changed = true;
        }

        if($changed)
            $this->save();
    }

    public static function createOrderId()
    {
        $year = date("y");
        $year_change = false;

        $last_order = self::latest()->first();
                
        $last_order_id = NULL;
        if(isset($last_order))
            $last_order_id = $last_order->id;        
        
        $last_id_year = (substr($last_order_id, 0, 2));
        if(isset($last_id_year) && $last_id_year != $year)
            $year_change = true;
        
        $letters = (substr($last_order_id, 2, 2) && !$year_change) ? substr($last_order_id, 2, 2) : 'AA';
        $number = (substr($last_order_id, -5) && !$year_change) ? substr($last_order_id, -5) : '0';
        
        //  increment letters/number if valid last user
        if (isset($last_order_id) && !$year_change) {
            if($number == '99999') {
                $letters++;
                $number = '0';
            } else {
                $number++;            
            }
        }
        
        //  construct new id
        $id = $year . $letters . str_pad($number, 5, '0', STR_PAD_LEFT);

        return $id;
    }

    public static function createNewOrder($data)
    {
        $order = new self;
        
        $order->id = self::createOrderId();
        $order->customer_id = Auth::user()->id ?? 'guest';
        $order->title = $data->title;        

        $order->save();

        return $order;
    }

    public function songs()
    {
        return $this->hasMany('App\Song', 'order_id', 'id');
    }
    
    public function shipping()
    {
        return $this->hasMany('App\Shipping', 'order_id', 'id');
    }
}
