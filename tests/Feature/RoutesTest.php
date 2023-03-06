<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testAllRoutes()
    {
        $routes = collect(Route::getRoutes())->map(function ($route) {
            return $route->uri();
        });

        $routes->each(function ($route) {
            $response = $this->get('/'.$route);

            $response->assertStatus(200);
        });
    }

}
