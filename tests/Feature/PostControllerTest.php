<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_pagination(): void
    {
        Post::factory()->count(15)->create();

        $response = $this->get('/posts?page=1');
        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');

        $response = $this->get('/posts?page=2');
        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }
}
