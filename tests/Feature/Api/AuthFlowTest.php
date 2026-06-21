<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_endpoint_exists(): void
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'password' => 'password123',
            'organization_name' => 'LeadConnect Labs',
        ]);

        $response->assertStatus(201);
    }
}
