<?php

namespace Tests\Feature;

use App\Facades\Users;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    private $name = 'useruser';
    private $email = 'user@user.com';
    private $password = 'qwertyqwerty';

    private $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();

        parent::setUp();
    }

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

    public function test_register_endpoint()
    {
        $response = $this->postJson('/api/users', [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => $password = $this->faker->password,
            'password_confirmation' => $password
        ]);

        $response->assertOk();
        $response->assertSeeText('ok');
    }

    public function test_register_validation_name()
    {
        $response = $this->postJson('/api/users', [
            'name' => Str::random(1),
            'email' => $this->faker->safeEmail,
            'password' => $password = $this->faker->password,
            'password_confirmation' => $password
        ]);

        $response->assertStatus(422);
    }

    public function test_register_validation_email()
    {
        $response = $this->postJson('/api/users', [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmailDomain,
            'password' => $password = $this->faker->password,
            'password_confirmation' => $password
        ]);

        $response->assertStatus(422);
    }

    public function test_register_validation_password()
    {
        $response = $this->postJson('/api/users', [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => $password = Str::random(5),
            'password_confirmation' => $password
        ]);

        $response->assertStatus(422);
    }

    public function test_register_validation_need_password_confirm()
    {
        $response = $this->postJson('/api/users', [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password
        ]);

        $response->assertStatus(422);
    }
}
