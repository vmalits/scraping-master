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

    public function test_it_fails_if_user_is_not_authenticated()
    {
        $response = $this->getJson('/api/campaigns');
        $response->assertStatus(401);
    }

    public function test_it_returns_a_collection_of_campaigns()
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $campaign = factory(Campaign::class)->create();
        $this->getJson('/api/campaigns')
            ->assertJsonFragment([
                'name' => $campaign->name
            ])->assertStatus(200);
    }

    public function test_it_adds_new_campaign()
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $this->postJson('/api/campaigns', [
            'name' => $name = 'test campaign'
        ])->assertStatus(201);
        $this->assertDatabaseHas('campaigns', [
            'name' => $name
        ]);
    }

    public function test_it_updates_campaign()
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

    public function test_it_shows_one_campaign_by_id()
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $campaign = factory(Campaign::class)->create();

        $response = $this->getJson('/api/campaigns/' . $campaign->id);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $campaign->id,
            'name' => $campaign->name
        ]);
    }

    public function test_it_returns_error_if_campaign_with_this_id_not_found()
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $response = $this->getJson('/api/campaigns/' . 1);
        $response->assertStatus(404);
    }

    public function test_it_deletes_the_campaign()
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $campaign = factory(Campaign::class)->create();
        $response = $this->deleteJson('/api/campaigns/' . $campaign->id);
        $response->assertStatus(204);
    }
}
