<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Order;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderIDTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function can_create_an_order_id()
    {
        $id = Order::createOrderId();

        $this->assertEquals('17AA00000', $id);
    }

    /** @test */
    public function can_increment_an_order_id()
    {
        factory(Order::class)->create(['id' => '17AA99999']);

        $id = Order::createOrderId();

        $this->assertEquals('17AB00000', $id);
    }

    /** @test */
    public function can_increment_an_order_id_year()
    {
        factory(Order::class)->create(['id' => '16BE74938']);

        $id = Order::createOrderId();

        $this->assertEquals('17AA00000', $id);
    }    
}
