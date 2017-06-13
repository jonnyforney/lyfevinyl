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

    public static function createCustomerID()
    {
        $year = date("y");

        $last_user = User::latest()->first();
        $number = (int) substr($last_user, -8) ?? '0';

        if($last_user) {                        
            //  increment number
            $number++;
        }
        //  construct new id
        $new_customer_id = $year . str_pad($number, 8, '0', STR_PAD_LEFT);

        return $new_customer_id;
    }
}
