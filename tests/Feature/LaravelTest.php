<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LaravelTest extends TestCase
{
    /** @test */
    public function home()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    /** @test */
    public function incidencia()
    {
        $this->get('/incidencia')
            ->assertStatus(200);
    }

}
