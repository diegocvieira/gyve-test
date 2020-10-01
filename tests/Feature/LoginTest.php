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
        $response = $this->get(route('user.login'));

        $response->assertStatus(200);
        $response->assertViewIs('user.login');
    }

    public function testUserCannotViewLoginPageWhenAuthenticated()
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get(route('user.login'));

        $response->assertRedirect(route('home'));
    }

    public function testUserCanLoginWithValidCredentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'userpass123'),
        ]);

        $response = $this->post(route('user.login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    public function testUserCannotLoginWithInvalidPassword()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'userpass123'),
        ]);

        $response = $this->from(route('user.login'))->post(route('user.login'), [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect(route('user.login'));
        $response->assertSessionHasErrors();

        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }
}
