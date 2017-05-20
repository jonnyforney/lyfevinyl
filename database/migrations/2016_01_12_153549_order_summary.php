<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderSummary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('order_summary', function (Blueprint $table) {
        $table->increments('id');
        $table->char('order_id',9);
        $table->char('customer_id',10);
        $table->string('status')->nullable();
        $table->integer('quantity')->default(1)->unsigned();
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
      Schema::drop('order_summary');
    }
}
