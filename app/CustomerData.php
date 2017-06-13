<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerData extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'customer_data';

  /**
  * connects orders to user
  */
  public function orders()
  {
     return $this->hasMany('App\OrderSummary','customer_id','customer_id');
  }

  /**
  * connects customer to address
  */
  public function address()
  {
    return $this->hasOne('App\ShipToAddresses','customer_id','customer_id');
  }

  public function vinyls() 
  {
    return $this->hasMany('App\Vinyls','customer_id','customer_id');
  }

  public function user() 
  {
    return $this->belongsTo('App\User','id','id');
  }
}
