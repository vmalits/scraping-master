<?php

namespace Tests\Feature\Controller\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LogOutControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_a_unauthentication_error_if_user_is_not_logged(): void
    {
        $response = $this->json('POST', 'api/auth/logout');
        $response->assertUnauthorized();
    }

    public function test_it_logout_a_user(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $response = $this->json('POST', 'api/auth/logout');
        $response->assertNoContent();
    }
}
