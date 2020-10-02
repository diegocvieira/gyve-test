<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateUserAccount()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
            'is_admin' => 1
        ]);

        $data = User::factory()->make()->toArray();
        $data['password'] = 'password';

        $this->actingAs($user)
            ->post(route('user.store'), $data)
            ->assertSessionHas('success')
            ->assertRedirect(route('user.index'));
    }

    public function testSearchForUsers()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $this->actingAs($user)
            ->get(route('user.search'), ['name' => 'teste'])
            ->assertStatus(200)
            ->assertViewIs('user.index');
    }

    public function testDeleteUserAccount()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $this->actingAs($user)
            ->delete(route('user.destroy'))
            ->assertSessionHas('success')
            ->assertRedirect(route('user.login'));
    }

    public function testUpdateUserAccount()
    {
        // $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $data = User::factory()->make()->toArray();

        $this->actingAs($user)
            ->put(route('user.update'), $data)
            ->assertSessionHas('success')
            ->assertRedirect(route('user.edit'));
    }

    public function testUserCanViewUserCreatePage()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $this->actingAs($user)
            ->get(route('user.create'))
            ->assertStatus(200)
            ->assertViewIs('user.create');
    }

    public function testUserCanViewEditPage()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $this->actingAs($user)
            ->get(route('user.edit'))
            ->assertStatus(200)
            ->assertViewIs('user.edit');
    }

    public function testUserCanViewIndexPage()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $this->actingAs($user)
            ->get(route('user.index'))
            ->assertStatus(200)
            ->assertViewIs('user.index');
    }
}
