<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\Organization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_campaign_from_web_page(): void
    {
        $response = $this->post('/campaigns', [
            'name' => 'Q3 Founder Sequence',
            'type' => 'Mixed Campaign',
            'status' => 'draft',
            'starts_at' => '2026-07-01',
        ]);

        $response->assertRedirect('/campaigns');

        $this->assertDatabaseCount('organizations', 1);
        $organization = Organization::query()->firstOrFail();

        $this->assertDatabaseHas('campaigns', [
            'organization_id' => $organization->id,
            'name' => 'Q3 Founder Sequence',
            'type' => 'Mixed Campaign',
            'status' => 'draft',
        ]);

        $this->assertNotNull(Campaign::query()->first()?->starts_at);
    }
}