<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersModuleTest extends TestCase{
    use RefreshDatabase;
  
    function test_usuarios_200(){
        User::factory()->create([
            'name' => 'Joel',
        ]);
        
        User::factory()->create([
            'name' => 'neita',
        ]);

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Joel')
            ->assertSee('neita');
    }

    function test_no_hay_usuarios_200(){
        User::all()->each->delete(); 
        $this->get('/usuarios')
            ->assertSee('No hay usuarios registrados.');
    }

    function test_usuarios_detail_200(){
        $user = User::factory(User::class)->create([
            'name' => 'Debaran',
        ]);

        $this->get("/usuarios/{$user->id}")
            ->assertSee('Debaran');
    }

    function test_usuarios_detail_404(){
        $this->get('usuarios/d')
            ->assertStatus(404)
            ->assertSee('404');

    }

    function test_usuarios_nuevo_200(){
        $this->get('/usuarios/nuevo')
            ->assertStatus(200);
    }

    function test_crear_usuario_nuevo_200(){
        $this->post('/usuarios', [
            'name' => 'Debaran',
            'email' => 'debaran@gmail.com',
            'password' => '123456',

        ])->assertRedirect(route('users'));
            
        $this->assertCredentials([
            'name' => 'Debaran',
            'email' => 'debaran@gmail.com',
            'password' => '123456',
        ]);
    }
}
