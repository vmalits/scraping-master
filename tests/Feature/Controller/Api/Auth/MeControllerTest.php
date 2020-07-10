<?php

namespace Tests\Feature\Controller\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_fails_if_user_is_not_authenticated()
    {
        $response = $this->json('GET','/api/auth/me');
        $response->assertStatus(401);
    }

    public function test_it_returns_user_data()
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $response = $this->json('GET','/api/auth/me');
        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
    }
}
