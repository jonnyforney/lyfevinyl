<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vinyls extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'vinyl_contents';

  /**
  * connects vinyl to order
  */
  public function order()
  {
    return $this->belongsTo('App\OrderSummary','vinyl_id','vinyl_id');
  }

  /**
  * connects vinyl to customer
  */
  public function customer() {
    return $this->belongsTo('App\CustomerData','customer_id','customer_id');
  }

  /**
  * connects vinyl to user
  */
  public function user() {
    return $this->belongsTo('App\User','id','customer_id');
  }
}
