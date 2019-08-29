<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /** @test */
    public function validacion_del_numero_del_cedula()
    {
        //$this->withoutExceptionHandling();
        // PREPARACION DE DATOS
        // password de usuario
        $password = 'password';
        // un grupo de números de cédula de prueba
        $test_cases = [
            '0000000000',
            '9999999999',
            'aaaaaaaaaa',
            'a1a1a1a1a1',
            '1723749501aaa',
            '17237495011a1',
            '17237495019991',
            '1',
            // TODO: pensar mas tests que pudieran pasar la validacion
        ];

        // INTENTO DE TEST
        foreach ($test_cases as $cedula) {
            $respuesta = $this->post('/login',[
                'cedula' => $cedula,
                'password' => $password,
            ]);

            // VALORACION DEL RESULTADO
            // validando que "haya" errores con el formato de la cedula
            $this->assertEquals(session('errors')->all()[0], 'El formato del campo cedula es inválido.');
        }

    }
}
