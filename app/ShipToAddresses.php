<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipToAddresses extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'ship_to_addresses';

  /**
  * connects address to customer
  */
  public function customer()
  {
    return $this->belongsTo('App\CustomerData','customer_id','customer_id');
  }

  public function user()
  {
    return $this->belongsTo('App\User','id','customer_id');
  }
}
