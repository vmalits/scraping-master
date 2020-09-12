<?php

namespace Tests\Feature\Controller\Api;

use App\Models\Proxy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProxyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_fails_if_user_is_not_authenticated(): void
    {
        $response = $this->getJson('/api/proxies');
        $response->assertUnauthorized();
    }

    public function test_it_returns_a_collection_of_proxies(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $proxy = factory(Proxy::class)->create();
        $response = $this->getJson('/api/proxies');
        $response->assertJsonFragment([
            'type' => $proxy->type,
        ])->assertOk();
    }

    public function test_it_adds_new_proxy(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $proxy = factory(Proxy::class)->make();
        $this->postJson('/api/proxies', $proxy->toArray())->assertCreated();
        $this->assertDatabaseHas('proxies', [
            'type' => $proxy->type,
            'ip' => $proxy->ip,
            'port' => $proxy->port,
        ]);
    }

    public function test_it_updates_proxy(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $proxy = factory(Proxy::class)->create();
        $updatedProxy = factory(Proxy::class)->make();

        $this->putJson('/api/proxies/' . $proxy->id, $updatedProxy->toArray());
        $this->assertDatabaseHas('proxies', [
            'type' => $updatedProxy->type,
            'ip' => $updatedProxy->ip,
            'port' => $updatedProxy->port,
        ]);
    }

    public function test_it_shows_one_proxy_by_id(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $proxy = factory(Proxy::class)->create();

        $response = $this->getJson('/api/proxies/' . $proxy->id);
        $response->assertOk();
        $response->assertJsonFragment([
            'id' => $proxy->id,
            'type' => $proxy->type
        ]);
    }

    public function test_it_returns_error_if_proxy_with_this_id_not_found(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $response = $this->getJson('/api/proxies/' . 1);
        $response->assertNotFound();
    }

    public function test_it_deletes_the_proxy(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $proxy = factory(Proxy::class)->create();
        $response = $this->deleteJson('/api/proxies/' . $proxy->id);
        $response->assertNoContent();
    }

    public function test_it_returns_error_if_ip_and_port_combination_already_exists(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $proxy = factory(Proxy::class)->create();
        $response = $this->postJson('/api/proxies', $proxy->toArray());
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('ip');
    }
}
