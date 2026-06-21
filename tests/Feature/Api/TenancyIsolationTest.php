<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class TenancyIsolationTest extends TestCase
{
    public function test_tenant_header_is_required_for_scoped_routes(): void
    {
        $response = $this->getJson('/api/v1/leads');

        $response->assertStatus(401);
    }
}
