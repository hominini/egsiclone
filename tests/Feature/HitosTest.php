<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HitosTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function un_admin_puede_crear_hitos()
    {
        // $this->withoutExceptionHandling();
        //  PREPARACION DE DATOS
        // login
        $user = crear_superadmin();
        $this->actingAs($user);

        // datos a enviar en el request
        $atributos = [
            'milestone_number' => $this->faker->word,
            'description' => 'Disponer la implementación del EGSI en la institución por la máxima autoridad.',
            'is_a_priority' => true,
            'category_number' => '10.10.' . $this->faker->numberBetween(1, 999999)
        ];

        // INTENTO DE OPERACION PRINCIPAL
        // intento de almacenar los datos
        $respuesta = $this->post('/milestones', $atributos);

        // VALORACION DE LA RESPUESTA ESPERADA
        // como resultado el nuevo hito se encuentra en la base de datos
        $this->assertDatabaseHas('milestones', $atributos);
    }

    /** @test */
    public function un_admin_puede_actualizar_hitos()
    {
        // $this->withoutExceptionHandling();
        //  PREPARACION DE DATOS
        // login
        $user = crear_superadmin();
        $this->actingAs($user);

        // se crea una hito para modificarlo
        $milestone = factory(\App\Milestone::class)->create();

        // datos a enviar en el request
        $atributos = [
            'milestone_number' => $this->faker->word,
            'description' => 'Disponer la implementación del EGSI en la institución por la máxima autoridad.',
            'is_a_priority' => true,
            'category_number' => '10.10.' . $this->faker->numberBetween(1, 999999)
        ];

        // INTENTO DE OPERACION PRINCIPAL
        // intento de almacenar los datos
        $respuesta = $this->patch('/milestones/' . $milestone->id, $atributos);

        // VALORACION DE LA RESPUESTA ESPERADA
        // como resultado el nuevo hito se encuentra en la base de datos
        $this->assertDatabaseHas('milestones', $atributos);
    }

}
