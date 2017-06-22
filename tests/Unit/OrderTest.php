<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Order;
use App\Song;
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

    /** @test */
    public function an_save_a_cover_path()
    {
        $order = factory(Order::class)->create(['id' => '17AA00001']);

        $path = '/path/to/cover/image';

        $order->store(['front_cover_path' => $path]);
        
        $this->assertEquals($order->front_cover_path, $path);        
    }

    /** @test */
    public function can_save_a_song()
    {
        $path = '/path/to/song/file';        

        $order = factory(Order::class)->create(['id' => '17AA00001']);
        $song = factory(Song::class)->create(['order_id' => $order->id, 'path' => $path, 'track' => 1, 'side' => 'A']); 

        Song::store($order, [['path' => $path.'/2', 'track' => 2, 'side' => 'A']]);

        $this->assertEquals(2, count($order->songs));        
    }

    /** @test */
    public function can_update_a_song()
    {
        $path = '/path/to/song/file';        

        $order = factory(Order::class)->create(['id' => '17AA00001']);
        $song = factory(Song::class)->create(['order_id' => $order->id, 'path' => $path, 'track' => 1, 'side' => 'A']); 

        Song::store($order, [['path' => $path.'/update', 'track' => 1, 'side' => 'A']]);

        $this->assertEquals(1, count($order->songs));        
    }

    /** @test */
    public function can_save_multiple_song()
    {
        $path = '/path/to/song/file';        

        $order = factory(Order::class)->create(['id' => '17AA00001']);        

        Song::store($order, 
                    [
                        ['path' => $path.'/1', 'track' => 1, 'side' => 'A'],
                        ['path' => $path.'/2', 'track' => 2, 'side' => 'A']
                    ]
        );
        
        $this->assertEquals(2, count($order->songs));        
    }
}
