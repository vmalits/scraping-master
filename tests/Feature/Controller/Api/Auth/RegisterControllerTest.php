<?php

namespace Tests\Feature\Controller\Api\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_requires_a_first_name()
    {
        $response = $this->json('POST', 'api/auth/register');
        $response->assertJsonValidationErrors('first_name');
    }

    public function test_it_requires_a_last_name()
    {
        $response = $this->json('POST', 'api/auth/register');
        $response->assertJsonValidationErrors('last_name');
    }

    public function test_it_requires_a_email()
    {
        $response = $this->json('POST', 'api/auth/register');
        $response->assertJsonValidationErrors('email');
    }

    public function test_it_requires_a_valid_email()
    {
        $response = $this->json('POST', 'api/auth/register', [
            'email' => 'some text'
        ]);
        $response->assertJsonValidationErrors('email');
    }

    public function test_it_requires_a_unique_email()
    {
        $user = factory(User::class)->create();
        $response = $this->json('POST', 'api/auth/register', [
            'email' => $user->email
        ]);
        $response->assertJsonValidationErrors('email');
    }

    public function test_it_requires_a_password()
    {
        $response = $this->json('POST', 'api/auth/register');
        $response->assertJsonValidationErrors('password');
    }

    public function test_it_registers_a_user()
    {
        $this->json('POST', 'api/auth/register', [
            'first_name' => $firstName = 'John',
            'last_name' => $lastName = 'White',
            'email' => $email = 'john_white@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email
        ]);
    }

    public function test_a_confirmation_email_is_send_upon_registration()
    {
        \Notification::fake();
        $this->json('POST', 'api/auth/register', [
            'first_name' => $firstName = 'John',
            'last_name' => $lastName = 'White',
            'email' => $email = 'john_white@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $user = User::first();
        \Notification::assertSentTo($user, VerifyEmail::class);
    }
}
