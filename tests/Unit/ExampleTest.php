<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
// use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }

    public function test_login()
    {
        $response = $this->get('/login');

        $response->assertViewIs('auth.login');
        
    }
    
    public function test_register()
    {
        $response = $this->get('/register');

        $response->assertViewIs('auth.register');
        
    }
    
    public function test_logout()
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('/logout');

        $response->assertRedirect('/home');
        
    }

    public function test_tareas_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('tareas.index'));$response->assertStatus(302)->assertRedirect('/home');
        
    }
    
    public function test_tareas_edit()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('tareas.edit',1));$response->assertStatus(302)->assertRedirect('/home');
        
    }

    public function test_cuotas_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('cuotas.index'));$response->assertStatus(302)->assertRedirect('/home');
        
    }

    public function test_registrar_incidencia()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('cuotas.excepcional'));

        $datos = [
            'concepto' => 'Concepto prueba unitaria',
            'fecha_emision' => '2023-03-10',
            'importe' => 25,
            'cliente_id' => 10,
            'notas' => 'Nota de prueba',
        ];

        $response = $this->post(route('cuotas.excepcional'), $datos);
        $response->assertRedirect(route('home'));
        
    }

    public function test_clientes_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('clientes.index'));
        $response->assertRedirect('/home');
        
    }

    public function test_empleados_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('empleados.index'));
        $response->assertRedirect('/home');
        
    }
}
