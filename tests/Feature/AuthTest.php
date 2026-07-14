<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_login()
    {
        $response = $this->post('/login', [
            'type'     => 'admin',
            'email'    => 'admin@madrasati.test',
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function invalid_credentials_return_error()
    {
        $response = $this->post('/login', [
            'type'     => 'admin',
            'email'    => 'wrong@test.com',
            'password' => 'wrong',
        ]);

        $response->assertRedirect('/login/admin');
    }

    /** @test */
    public function login_page_loads()
    {
        $response = $this->get('/login/admin');
        $response->assertStatus(200);
    }
}
