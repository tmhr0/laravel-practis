<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
class ExampleTest extends TestCase
{
    public function test_お試し(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
    public function test_login_view_text_match(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200)
            ->assertViewIs('auth.login')
            ->assertSee('Remember me')
            ->assertSee('Forgot your password?');
    }
}
