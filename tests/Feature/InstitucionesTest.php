<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class InstitucionesTest extends TestCase
{
    use WithFaker;

    public function setUp() :void
    {
        parent::setUp();
        // now re-register all the roles and permissions
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    /** @test */
    public function un_admin_puede_crear_instituciones()
    {
        // $this->withoutExceptionHandling();
        // setup de datos
        $icon = UploadedFile::fake()->image('icon.jpg');
        $institution_picture = UploadedFile::fake()->image('instituto_logo.jpg');

        // login
        $user = crear_superadmin();
        $this->actingAs($user);

        $atributos = [
            'name' => 'Secretaria Nacional de Telecomunicaciones',
            'acronym' => 'SNT',
            'description' => $this->faker->paragraph(),
            'institution_picture' => $institution_picture,
            'website' => 'https://www.snt.ec',
            'icon' => $icon,
            'clasification' => 'Ejecutiva',
            'sector' => 'Judicial',
        ];

        // intenta crear institucion
        $this->post('/institutions', $atributos);

        // como resultado el nuevo usario se encuentra en la base de datos
        $this->assertDatabaseHas('institutions', [
            'name' => $atributos['name'],
            'acronym' => $atributos['acronym'],
        ]);

        // setdown data
        // se elimina las imagenes de prueba creadas
        Storage::disk('public')->delete('pictures/' . $institution_picture->hashName());
        Storage::disk('public')->delete('icons/' . $icon->hashName());
    }

    /** @test */
    public function un_usuario_puede_actualizar_instituciones()
    {
        $this->withoutExceptionHandling();
        // setup de datos
        // creando un icono de prueba
        $icon = UploadedFile::fake()->image('icon.jpg');
        // creando una imagen institucional de prueba
        $institution_picture = UploadedFile::fake()->image('instituto_logo.jpg');

        // simulando loguin de un usuario
        $user = crear_superadmin();
        $this->actingAs($user);

        // se crea una institucioon para modificarla
        $institution = factory(\App\Institution::class)->create();

        // atributos para pasar en la peticion
        $atributos = [
            'name' => 'Secretaria Nacional de Telecomunicaciones',
            'acronym' => 'SNT',
            'description' => $this->faker->paragraph(),
            'institution_picture' => $institution_picture,
            'website' => 'https://www.snt.ec',
            'icon' => $icon,
            'clasification' => 'Ejecutiva',
            'sector' => 'Judicial',
        ];

        // intenta actualizar la institucion
        $this->patch('/institutions/' . $institution->id, $atributos);

        // como resultado el nuevo usario se encuentra en la base de datos
        $this->assertDatabaseHas('institutions', [
            'name' => $atributos['name'],
            'acronym' => $atributos['acronym'],
        ]);

        // Assert the file was stored...
        // Storage::disk('local')->assertExists('public/fotos_usuarios/' . $foto->hashName());

        // setdown data
        // se elimina las imagenes de prueba creadas
        Storage::disk('public')->delete('pictures/' . $institution_picture->hashName());
        Storage::disk('public')->delete('icons/' . $icon->hashName());
    }

    /** @test */
    public function se_puede_subir_imagen_institucion()
    {
        $this->withoutExceptionHandling();
        // preparacion de datos
        // creando un icono de prueba
        $icon = UploadedFile::fake()->image('icon.jpg');
        // creando una imagen de prueba
        $institution_picture = UploadedFile::fake()->image('instituto_logo.jpg');

        // simulando login de un usuario
        $user = crear_superadmin();
        $this->actingAs($user);

        // atributos para pasar en el request
        $atributos = [
            'name' => 'Secretaria Nacional de Telecomunicaciones',
            'acronym' => 'SNT',
            'description' => $this->faker->paragraph(),
            'institution_picture' => $institution_picture,
            'website' => 'https://www.snt.ec',
            'icon' => $icon,
            'clasification' => 'Ejecutiva',
            'sector' => 'Judicial',
        ];

        // intenta crear institucion
        $this->post('/institutions', $atributos);

        // comprobacion de que las imagenes se almacenaron
        Storage::disk('public')->assertExists('pictures/' . $institution_picture->hashName());
        Storage::disk('public')->assertExists('icons/' . $icon->hashName());

        // se elimina las imagenes de prueba creadas
        Storage::disk('public')->delete('pictures/' . $institution_picture->hashName());
        Storage::disk('public')->delete('icons/' . $icon->hashName());
    }

}
