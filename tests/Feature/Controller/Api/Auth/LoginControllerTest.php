<?php

namespace Tests\Feature\Controller\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_requires_a_email(): void
    {
        $response = $this->json('POST', 'api/auth/register');
        $response->assertJsonValidationErrors('email');
    }

    public function test_it_requires_a_password(): void
    {
        $response = $this->json('POST', 'api/auth/register');
        $response->assertJsonValidationErrors('password');
    }

    public function test_it_returns_errors_if_credentials_dont_match(): void
    {
        $user = factory(User::class)->create();
        $response = $this->json('POST', 'api/auth/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);
        $response->assertJsonValidationErrors('email');
    }

    public function test_it_returns_a_token_if_credentials_do_match(): void
    {
        factory(User::class)->create([
            'email' => $email = 'test@gmail.com',
            'password' => $password = 'password'
        ]);
        $response = $this->json('POST', 'api/auth/login', [
            'email' => $email,
            'password' => $password
        ]);
        $response->assertOk();
        $response->assertJsonStructure(['token']);
    }

    public function test_it_returns_a_unauthorized_error_if_email_is_not_verified(): void
    {
        factory(User::class)->create([
            'email' => $email = 'test@gmail.com',
            'password' => $password = 'password',
            'email_verified_at' => null
        ]);
        $response = $this->json('POST', 'api/auth/login', [
            'email' => $email,
            'password' => $password
        ]);

        $response->assertJsonFragment(['message' => 'Please verify email!']);
    }
}
