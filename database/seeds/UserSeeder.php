<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // se crea usuarios de prueba
        User::create([
            'name' => 'juan',
            'email' => 'juan@mail.com',
            'password' => 'password',
            'nombres' => 'Juan',
            'apellidos' => 'Ramirez',
            'cedula' => '1123749502',
            'cargo' => 'Jefe de TICS',
            'area' => 'Departamento de Tecnología',
            'institucion_id' => 1,
        ])->assignRole('Oficial de Seguridad de la Información');

        User::create([
            'name' => 'rosa',
            'email' => 'rosa@mail.com',
            'password' => 'password',
            'nombres' => 'Rosa',
            'apellidos' => 'Flores',
            'cedula' => '0523749503',
            'cargo' => 'Jefe de TICS',
            'area' => 'Departamento de Tecnología',
            'institucion_id' => 1,
        ])->assignRole('Oficial de Seguridad de la Información');


        User::create([
            'name' => 'María',
            'email' => 'maria@mail.com',
            'password' => 'password',
            'nombres' => 'María',
            'apellidos' => 'Cantuña',
            'cedula' => '0923749504',
            'cargo' => 'Experto de TICS',
            'area' => 'Departamento de Tecnología',
            'institucion_id' => 3,
        ])->assignRole('Evaluador del Mintel');


    }
}
