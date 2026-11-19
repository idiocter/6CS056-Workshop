<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Training Institute Management System');
    }

    public function test_assets_use_the_forwarded_https_scheme(): void
    {
        $response = $this
            ->withHeader('X-Forwarded-Proto', 'https')
            ->get('/');

        $response->assertSee('href="https://', escape: false);
        $response->assertSee('/css/app.css', escape: false);
    }
}
