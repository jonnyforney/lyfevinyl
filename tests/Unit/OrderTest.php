<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Order;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function can_create_an_order()
    {
        $id = Order::createOrderId();

        $this->assertEquals('17AA00000', $id);
    }

    /** @test */
    public function can_increment_an_order()
    {
        factory(Order::class)->create(['id' => '17AA99999']);

        $id = Order::createOrderId();

        $this->assertEquals('17AB00000', $id);
    }

    /** @test */
    public function can_increment_an_order_year()
    {
        factory(Order::class)->create(['id' => '16BE74938']);

        $id = Order::createOrderId();

        $this->assertEquals('17AA00000', $id);
    }

    /** @test */
    public function a_user_can_create_an_order_via_an_api()
    {
        $user = factory(User::class)->make(['id' => '1700000000']);

        $response = $this->json('POST', '/create/order');

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
                'order_id' => '17AA00000'
            ]);
    }
}
