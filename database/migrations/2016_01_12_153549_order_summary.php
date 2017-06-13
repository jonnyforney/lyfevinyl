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
        $table->string('order_id',9)->index();
        $table->string('customer_id',10);
        $table->string('status')->nullable();
        $table->integer('quantity')->default(1)->unsigned();
        $table->char('vinyl_title',50);
        $table->binary('vinyl_front_cover');
        $table->binary('vinyl_back_cover');
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
