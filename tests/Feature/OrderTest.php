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

        $this->post(route('user.login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response = $this->get(route('home'));

        $this->assertAuthenticatedAs($user);
        $response->assertStatus(200);
        $response->assertViewIs('home');
    }

    public function testCreateNewOrder()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $this->post(route('user.login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response = $this->from(route('home'))->post(route('order.store'));

        $this->assertAuthenticatedAs($user);
        $response->assertSessionHas('success');
        $response->assertRedirect(route('home'));
    }

    public function testChangeOrderState()
    {
        // $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $this->post(route('user.login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->from(route('home'))->post(route('order.store'));

        $order = Order::create([
            'user_id' => $user->id,
            'control_number' => rand(99999, 99999)
        ]);

        $data = ['order_id' => $order->id, 'state' => 2];

        $response = $this->from(route('home'))->put(route('order.update.state'), $data);

        $this->assertAuthenticatedAs($user);
        $response->assertSessionHas('success');
        $response->assertRedirect(route('home'));
    }

    public function testOrderSearch()
    {
        // $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $this->post(route('user.login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response = $this->from(route('home'))->get(route('order.search'), ['state' => 1]);

        $this->assertAuthenticatedAs($user);
        $response->assertStatus(200);
        $response->assertViewIs('home');
    }
}
