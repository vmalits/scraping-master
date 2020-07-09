<?php

namespace Tests\Feature\Controller\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_it_requires_a_email()
    {
        $response = $this->json('POST', 'api/auth/register');
        $response->assertJsonValidationErrors('email');
    }

    public function test_it_requires_a_password()
    {
        $response = $this->json('POST', 'api/auth/register');
        $response->assertJsonValidationErrors('password');
    }

    public function test_it_returns_errors_if_credentials_dont_match()
    {
        $user = factory(User::class)->create();
        $response = $this->json('POST', 'api/auth/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);
        $response->assertJsonValidationErrors('email');
    }

    public function test_it_returns_a_token_if_credentials_do_match()
    {
        $this->withExceptionHandling();
        $user = factory(User::class)->create();
        $response = $this->json('POST', 'api/auth/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $response->assertJsonStructure(['token']);
    }
}
