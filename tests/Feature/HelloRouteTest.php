<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelloRouteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHelloRoute()
    {
        $response = $this->get('/hello');

        $response->assertStatus(200);
        // $response->assertStatus(404);
    }

    public function testFoobarGet()
    {
        $response = $this->get('/foobar');
        $response->assertStatus(200);
    }

    public function testFoobarPost()
    {
        $response = $this->post('/foobar');
        $response->assertStatus(200);
    }

    public function testFoomarGet()
    {
        $response = $this->get('/foomar');
        $response->assertStatus(200);
    }

    public function testFoomarPut()
    {
        $response = $this->put('/foomar');
        $response->assertStatus(200);
    }

    public function testFoomarPatch()
    {
        $response = $this->patch('/foomar');
        $response->assertStatus(200);
    }

    public function testBarName()
    {
        $response = $this->get(route('bar'));
        $response->assertStatus(200);
    }

    public function testBarzName()
    {
        $response = $this->get(route('barz'));
        $response->assertStatus(200);
    }
    
    public function testBarabName()
    {
        $response = $this->get(url('barab'));
        $response->assertStatus(200);
    }


    public function testWelcomeView()
    {
        $response = $this->get('/');
        $response->assertViewIs('welcome');
    }

    public function testHeyView()
    {
        $response = $this->get('/hey');
        $response->assertViewIs('hello');
    }

    public function assert_view_has_bazuka()
    {
        $this->get('bazuka')
            ->assertViewHas('title', 'Bazuka Page');
    }

}
