<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
        
    public function test_index_method()
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
        $response->assertViewHas('title');
        $response->assertViewHasAll(['title', 'fooUrl', 'posts']);
        // dump($response);
        $response->assertSeeText('Blog posts');        
    }
}