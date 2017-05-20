<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShipToAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('ship_to_addresses', function (Blueprint $table) {
        $table->increments('id');
        $table->char('customer_id',10);
        $table->string('street1',50)->nullable();
        $table->string('street2',50)->nullable();
        $table->string('city',50)->nullable();
        $table->string('state',50)->nullable();
        $table->string('zip',15)->nullable();
        $table->string('country',50)->nullable();
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('ship_to_addresses');
    }
}
