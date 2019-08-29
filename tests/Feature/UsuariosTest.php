<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;

class UsuariosTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function un_admin_puede_registrar_usuarios()
    {
        // $this->withoutExceptionHandling();
        // setup de datos
        $cedula = '1723749502';

        // login
        $admin = crear_superadmin();
        $this->actingAs($admin);

        $atributos = [
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'nombres' => 'Daniela',
            'apellidos' => 'Ortega',
            'cedula' => '17237' . $this->faker->numberBetween(10000, 99999),
            'cargo' => 'secretario',
            'area' => 'Departamento de Tecnología',
            'institucion_id' => 6,
            'roles' => ['Oficial de Seguridad de la Información'],
        ];

        // intenta crear usuario
        $this->post('/users', $atributos)->assertRedirect('/users');

        // como resultado el nuevo usario se encuentra en la base de datos
        $this->assertDatabaseHas('users', [
            'cedula' => $cedula,
        ]);
        // como resultado el usario es redirigido a la pagina index del usuario

    }

    /** @test */
    public function un_admin_puede_actualizar_usuarios()
    {
        // $this->withoutExceptionHandling();
        // setup de datos
        $user = User::create([
            'name' => 'Daniela',
            'email' => $this->faker->email,
            'password' => Hash::make('password'),
            'nombres' => 'Daniela',
            'apellidos' => 'Ortega',
            'cedula' => '17237' . $this->faker->numberBetween(10000, 99999),
            'cargo' => 'Oficial de Seguridad de la Información',
            'area' => 'Departamento de RRHH',
            'institucion_id' => 6,
        ]);
        $user->assignRole('Oficial de Seguridad de la Información');

        // login
        $admin = crear_superadmin();
        $this->actingAs($admin);

        $atributos = [
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'nombres' => 'Daniela',
            'apellidos' => 'Ortega',
            'cedula' => '17237' . $this->faker->numberBetween(10000, 99999),
            'cargo' => 'secretario',
            'area' => 'Departamento de Tecnología',
            'institucion_id' => 8,
            'roles' => ['Oficial de Seguridad de la Información'],
        ];

        // intenta actualizar usuario
        $this->patch('/users/' . $user->id, $atributos);
        // dd(session('errors'));
        // como resultado los cambios en el usuario se ven reflejados en la bdd
        $this->assertDatabaseHas('users', [
            'email' => $atributos['email'],
            // 'password' => $user->password,
            'nombres' => $atributos['nombres'],
            'apellidos' => $atributos['apellidos'],
            'cedula' => $atributos['cedula'],
            'cargo' => $atributos['cargo'],
            'area' => $atributos['area'],
            'institucion_id' => $atributos['institucion_id'],
            // 'roles' => ['Oficial de Seguridad de la Información'],
        ]);
    }

    /** @test */
    public function un_usuario_se_puede_loguear_con_la_cedula()
    {
        // $this->withoutExceptionHandling();
        // setup datos
        $user = crear_usuario_regular();

        $params =[
            'cedula' => $user->cedula,
            'password' => 'password',
        ];

        // intento de logueo
        $respuesta = $this->post('/login', $params);

        // verificar logueo
        $respuesta->assertRedirect('/admin');
    }



}
