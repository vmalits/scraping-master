<?php

namespace Tests\Feature\Controller\Api;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CampaignControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_fails_if_user_is_not_authenticated(): void
    {
        $response = $this->getJson('/api/campaigns');
        $response->assertUnauthorized();
    }

    public function test_it_returns_a_collection_of_campaigns(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $campaign = factory(Campaign::class)->create();
        $this->getJson('/api/campaigns')
            ->assertJsonFragment([
                'name' => $campaign->name
            ])->assertOk();
    }

    public function test_it_adds_new_campaign(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $this->postJson('/api/campaigns', [
            'name' => $name = 'test campaign'
        ])->assertCreated();
        $this->assertDatabaseHas('campaigns', [
            'name' => $name
        ]);
    }

    public function test_it_updates_campaign(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $campaign = factory(Campaign::class)->create();
        $campaign->name = 'new name';

        $this->putJson('/api/campaigns/' . $campaign->id, [
            'name' => $campaign->name
        ]);
        $this->assertDatabaseHas('campaigns', [
            'name' => 'new name'
        ]);
    }

    public function test_it_shows_one_campaign_by_id(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $campaign = factory(Campaign::class)->create();

        $response = $this->getJson('/api/campaigns/' . $campaign->id);
        $response->assertOk();
        $response->assertJsonFragment([
            'id' => $campaign->id,
            'name' => $campaign->name
        ]);
    }

    public function test_it_returns_error_if_campaign_with_this_id_not_found(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $response = $this->getJson('/api/campaigns/' . 1);
        $response->assertNotFound();
    }

    public function test_it_deletes_the_campaign(): void
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $campaign = factory(Campaign::class)->create();
        $response = $this->deleteJson('/api/campaigns/' . $campaign->id);
        $response->assertNoContent();
    }
}
