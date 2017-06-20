<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function createCustomerID($type)
    {
        $year = date("y");

        $last_user = self::latest()->first();
        $number = (int) substr($last_user, -8) ?? '0';

        //  increment number if valid last user
        if (isset($last_user))
            $number++;
        
        //  construct new id
        $new_customer_id = $year . str_pad($number, 8, '0', STR_PAD_LEFT);

        //  create customerdata entry
        // $customer = new CustomerData;    
        // $customer->customer_id = $new_customer_id;
        // $customer->has_account = ($type == 'registration');
        // $customer->save();

        //  store id in session
        session(['customer_id' => $new_customer_id]);
 
        return $new_customer_id;
    }
}
