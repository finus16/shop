<?php

namespace Tests\Feature;

use App\Facades\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private $name = 'useruser';
    private $email = 'user@user.com';
    private $password = 'qwertyqwerty';

    public function test_can_login()
    {
        $response = $this->postJson('/api/login', [
            'email' => $this->email,
            'password' => $this->password
        ]);

        $response->assertStatus(401);

        $this->registerUser();

        $response = $this->postJson('/api/login', [
            'email' => $this->email,
            'password' => $this->password
        ]);

        $response->assertOk();
        $response->assertSeeText('access_token');
        $response->assertSeeText('token_type');
        $response->assertSeeText('expires_in');
    }

    private function registerUser()
    {

        Users::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);
    }
}
