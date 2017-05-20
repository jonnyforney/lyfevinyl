<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VinylContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('vinyl_contents', function (Blueprint $table) {
        $table->increments('id')->unsigned();
        $table->integer('vinyl_id')->nullable()->unsigned();
        $table->char('customer_id',10);
        $table->char('order_id',9);
        $table->integer('sort_order')->nullable();
        $table->text('side')->nullable();
        $table->text('title')->nullable();
        $table->text('link')->nullable();
        $table->integer('duration')->default(0)->unsigned();
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
      Schema::drop('vinyl_contents');
    }
}
