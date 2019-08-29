<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FullfillmentActivitiesTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function un_usuario_puede_crear_una_actividad()
    {
        $this->withoutExceptionHandling();
        //  PREPARACION DE DATOS
        // se crea una cumplimiento
        $fulfillment_id = factory(\App\Fulfillment::class)->create()->id;
        // se crea un archivo de prueba
        $document = UploadedFile::fake()->image('icon.jpg');

        // se crea un admin
        $admin = crear_superadmin();

        // login
        $this->actingAs($admin);

        // datos a enviar en el request
        $atributos = [
            'fulfillment_id' => $fulfillment_id,
            'activity_summary' => $this->faker->paragraph,
            'evidence_file' => $document,
        ];

        // INTENTO DE OPERACION PRINCIPAL
        // intento de almacenar los datos
        $respuesta = $this->post('/fulfillment_activities', $atributos);

        // VALORACION DE LA RESPUESTA ESPERADA
        // como resultado el nuevo hito se encuentra en la base de datos
        $this->assertDatabaseHas('fulfillment_activities', [
            'fulfillment_id' => $fulfillment_id,
            'activity_summary' => $atributos['activity_summary'],
        ]);

        // comprobacion de que el documento de comprobacio se almaceno
        Storage::disk('public')->assertExists('verifiables/' . $document->hashName());

        // se elimina el archivo creado
        Storage::disk('public')->delete('verifiables/' . $document->hashName());

    }

    /** @test */
    public function un_usuario_puede_editar_una_actividad()
    {
        $this->withoutExceptionHandling();
        //  PREPARACION DE DATOS
        // se crea una cumplimiento
        $new_fulfillment_id = factory(\App\Fulfillment::class)->create()->id;
        // se crea un archivo de prueba
        $new_document = UploadedFile::fake()->image('icon.jpg');

        // login
        $user = crear_superadmin();
        $this->actingAs($user);

        // se crea una actividad para modificar
        $fulfillment_activity = factory(\App\FulfillmentActivity::class)->create();

        // datos a enviar en el request
        $atributos = [
            'fulfillment_id' => $new_fulfillment_id,
            'activity_summary' => $this->faker->paragraph,
            'evidence_file' => $new_document,
        ];

        // INTENTO DE OPERACION PRINCIPAL
        // intento de almacenar los datos
        $respuesta = $this->patch('/fulfillment_activities/' . $fulfillment_activity->id, $atributos);

        // VALORACION DE LA RESPUESTA ESPERADA
        // como resultado el nuevo hito se encuentra en la base de datos
        $this->assertDatabaseHas('fulfillment_activities', [
            'fulfillment_id' => $new_fulfillment_id,
            'activity_summary' => $atributos['activity_summary'],
        ]);

        // comprobacion de que el documento de comprobacio se almaceno
        Storage::disk('public')->assertExists('verifiables/' . $new_document->hashName());

        // se elimina el archivo creado
        Storage::disk('public')->delete('verifiables/' . $new_document->hashName());
    }
}
