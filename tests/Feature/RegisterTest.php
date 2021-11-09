<?php

namespace Tests\Feature;

use App\Facades\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    private $name = 'useruser';
    private $email = 'user@user.com';
    private $password = 'qwertyqwerty';

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_register()
    {
        $this->assertDatabaseMissing('users', [
            'email' => $this->email
        ]);

        $this->assertEquals(true, Users::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]));

        $this->assertDatabaseHas('users', [
            'email' => $this->email
        ]);
    }
}
