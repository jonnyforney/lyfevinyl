<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\CustomerData;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CustomerIDTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function can_create_a_customer_id()
    {
        $id = User::createCustomerId();

        $this->assertEquals('1700000000', $id);
        $this->assertEquals('1700000000', session('customer_id'));
        $this->assertEquals(1, count(CustomerData::all()));
    }

    /** @test */
    public function can_increment_a_customer_id()
    {
        factory(User::class)->create(['id' => '1700009874']);

        $id = User::createCustomerId();

        $this->assertEquals('1700009875', $id);
        $this->assertEquals('1700009875', session('customer_id'));       
    }

    /** @test */
    public function can_increment_a_customer_id_year()
    {
        factory(User::class)->create(['id' => '1600009874']);

        $id = User::createCustomerId();

        $this->assertEquals('1700000000', $id);
        $this->assertEquals('1700000000', session('customer_id'));       
    }    
}
