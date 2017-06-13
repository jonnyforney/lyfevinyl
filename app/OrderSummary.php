<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderSummary extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'order_summary';

  /**
  * connects customer to order
  */
  public function customer()
  {
    return $this->hasOne('App\CustomerData','customer_id','id');
  }

  /**
  * connects user to order
  */
  public function user()
  {
    return $this->hasOne('App\User','id','id');
  }

  /**
  * connects vinyl to order
  */
  public function vinyl()
  {
    return $this->hasMany('App\Vinyls','vinyl_id','vinyl_id');
  }
}
