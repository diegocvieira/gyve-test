<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCanViewOrderPage()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $this->actingAs($user)
            ->get(route('home'))
            ->assertStatus(200)
            ->assertViewIs('home');
    }

    public function testCreateNewOrder()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $this->actingAs($user)
            ->from(route('home'))
            ->post(route('order.store'))
            ->assertSessionHas('success')
            ->assertRedirect(route('home'));
    }

    public function testChangeOrderState()
    {
        // $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'control_number' => rand(99999, 99999)
        ]);

        $data = ['order_id' => $order->id, 'state' => 2];

        $this->actingAs($user)
            ->from(route('home'))
            ->put(route('order.update.state'), $data)
            ->assertSessionHas('success')
            ->assertRedirect(route('home'));
    }

    public function testOrderSearch()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $this->actingAs($user)
            ->get(route('order.search'), ['state' => 1])
            ->assertStatus(200)
            ->assertViewIs('home');
    }
}
