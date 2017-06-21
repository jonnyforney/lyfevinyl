<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $keyType = 'string';
    public $incrementing = false;

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
        $year_change = false;

        $last_user = self::latest()->first();

        $last_user_id = NULL;
        if(isset($last_user))
            $last_user_id = $last_user->id;        
        
        $last_id_year = (substr($last_user_id, 0, 2));
        if(isset($last_id_year) && $last_id_year != $year)
            $year_change = true;
        
        $number = (substr($last_user_id, -8) && !$year_change) ? substr($last_user_id, -8) : '0';
        
        //  increment letters/number if valid last user
        if (isset($last_user_id) && !$year_change)
            $number++;                
        
        //  construct new id
        $new_customer_id = $year . str_pad($number, 8, '0', STR_PAD_LEFT);

        //  create customerdata entry
        $customer = new CustomerData;    
        $customer->customer_id = $new_customer_id;
        // $customer->has_account = ($type == 'registration');
        $customer->save();

        //  store id in session
        // session(['customer_id' => $new_customer_id]);
 
        return $new_customer_id;
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'customer_id', 'id');
    }
}
