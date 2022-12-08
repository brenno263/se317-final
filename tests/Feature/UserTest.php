<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{

    protected $userData = [
        'name' => 'Test User McGee',
        'email' => 'test.user.mcgee@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    private function get_user(): User|null {
        /** @var User|null $user */
        $user = User::query()
            ->where('name', $this->userData['name'])
            ->where('email', $this->userData['email'])
            ->first();
        return $user;
    }

    private function delete_user() {
        $user = $this->get_user();
        $user?->delete();
    }

    private function create_user(): User {
        $this->delete_user();

        $user = new User();
        $user->name = $this->userData['name'];
        $user->email = $this->userData['email'];
        $user->password = Hash::make($this->userData['password']);
        $user->save();

        return $user;
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_user()
    {
        $this->delete_user();
        $response = $this->post(route('users.create'), $this->userData);

        $response->assertRedirect(route('login'));
    }

    public function test_login() {
        $this->create_user();

        $res = $this->post(route('authenticate'), $this->userData);

        $res->assertRedirect();
    }

    public function test_delete_user() {
        $user = $this->create_user();

        $res = $this->actingAs($user)->delete(route('users.destroy', ['user' => $user]));
        $res->assertStatus(302);
        $res->assertRedirect(route('landing'));

        $this->assertTrue($this->get_user() == null);
    }
}
