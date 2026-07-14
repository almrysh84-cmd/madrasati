<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    /** @test */
    public function api_login_endpoint_exists()
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'email'    => 'test@example.com',
            'password' => 'wrong',
            'type'     => 'admin',
        ]);

        // 401 = unauthorized (endpoint works, credentials wrong)
        $this->assertContains($response->status(), [401, 422, 200]);
    }

    /** @test */
    public function api_protected_routes_require_auth()
    {
        $response = $this->getJson('/api/v1/students');
        $response->assertStatus(401);
    }
}
