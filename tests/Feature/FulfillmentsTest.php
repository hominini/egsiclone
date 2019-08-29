<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FulfillmentsTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function un_usuario_puede_crear_cumplimientos()
    {
        $this->withoutExceptionHandling();
        //  PREPARACION DE DATOS
        // se crea una institucion
        $institution_id = factory(\App\Institution::class)->create()->id;

        // se crea un hito
        $milestone_id = factory(\App\Milestone::class)->create()->id;

        // se crea un admin
        $admin = crear_superadmin();

        // se crea un admin
        $user = crear_usuario_regular();

        // login
        $this->actingAs($admin);

        // datos a enviar en el request
        $atributos = [
            'institution_id' => $institution_id,
            'milestone_id' => $milestone_id,
            'fulfillment_date' => $this->faker->date,
            'oficial_de_seguridad_id' => $user->id,
            'responsable_id' => $admin->id,
        ];

        // INTENTO DE OPERACION PRINCIPAL
        // intento de almacenar los datos
        $respuesta = $this->post('/fulfillments', $atributos);

        // VALORACION DE LA RESPUESTA ESPERADA
        // como resultado el nuevo hito se encuentra en la base de datos
        $this->assertDatabaseHas('fulfillments', $atributos);
    }

    /** @test */
    public function un_usuario_puede_actualizar_cumplimientos()
    {
        $this->withoutExceptionHandling();
        //  PREPARACION DE DATOS

        // se crea una institucion
        $institution_id = factory(\App\Institution::class)->create()->id;

        // se crea un hito
        $milestone_id = factory(\App\Milestone::class)->create()->id;

        // login
        $user = crear_superadmin();
        $this->actingAs($user);

        // se crea una cumplimiento para modificarlo
        $fulfillment = factory(\App\Fulfillment::class)->create();

        // datos a enviar en el request
        $atributos = [
            'institution_id' => $institution_id,
            'milestone_id' => $milestone_id,
            'fulfillment_date' => $this->faker->date,
            'oficial_de_seguridad_id' => $user->id,
        ];

        // INTENTO DE OPERACION PRINCIPAL
        // intento de almacenar los datos
        $respuesta = $this->patch('/fulfillments/' . $fulfillment->id, $atributos);

        // VALORACION DE LA RESPUESTA ESPERADA
        // como resultado el nuevo hito se encuentra en la base de datos
        $this->assertDatabaseHas('fulfillments', $atributos);
    }
}
