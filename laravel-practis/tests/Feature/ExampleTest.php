<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_お試し(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
