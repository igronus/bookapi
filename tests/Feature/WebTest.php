<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WebTest extends TestCase
{
    public function testRoot()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testSearch()
    {
        $response = $this->get('/search');

        $response->assertStatus(200)
            ->assertJson([
                'status' => false,
                'data' => "No search parameter",
            ]);
    }

    public function test404()
    {
        $response = $this->get(sprintf('/%s', md5(time())));

        $response->assertStatus(404);
    }
}
