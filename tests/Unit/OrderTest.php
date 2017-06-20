<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function a_user_can_create_an_order()
    {
        $user = factory(User::class)->create(['id' => '1700000008']);

        $this->actingAs($user)
            ->post('/add/order', ['title' => 'My Vinyl'])
            ->assertStatus(200)
            ->assertJson([
                'id' => '17AA00000'
            ]);

        $this->assertEquals(1, count($user->orders));
        $this->assertEquals('My Vinyl', $user->orders[0]->title);
    }

    /** @test */
    public function a_guest_can_create_an_order()
    {
        $this->post('/add/order', ['title' => 'My Guest Vinyl'])
            ->assertStatus(200)
            ->assertJson([
                'id' => '17AA00000',
                'customer_id' => 'guest',
                'title' => 'My Guest Vinyl'
            ]);
    } 

}
