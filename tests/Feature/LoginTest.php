<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserCanViewLoginPage()
    {
        $this->get(route('user.login'))
            ->assertStatus(200)
            ->assertViewIs('user.login');
    }

    public function testUserCannotViewLoginPageWhenAuthenticated()
    {
        $user = User::factory()->make();

        $this->actingAs($user)
            ->get(route('user.login'))
            ->assertRedirect(route('home'));
    }

    public function testUserCanLoginWithValidCredentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'userpass123'),
        ]);

        $data = [
            'email' => $user->email,
            'password' => $password
        ];

        $this->post(route('user.login'), $data)
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    public function testUserCannotLoginWithInvalidPassword()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'userpass123'),
        ]);

        $data = [
            'email' => $user->email,
            'password' => 'invalid-password'
        ];

        $this->from(route('user.login'))
            ->post(route('user.login'), $data)
            ->assertRedirect(route('user.login'))
            ->assertSessionHasErrors();

        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
}
